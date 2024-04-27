# Base image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpng-dev \
    && docker-php-ext-install zip pdo_mysql gd \
    && a2enmod rewrite

RUN docker-php-ext-enable gd
RUN docker-php-ext-enable pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install Laravel dependencies
RUN composer install

COPY ./.env.example /var/www/html/.env

# Generate Laravel key
RUN php artisan key:generate

# RUN php artisan migrate

# Configure Apache document root to /public
RUN sed -i -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i -e 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Expose port 8888
EXPOSE 8891

# Start Apache
CMD ["apache2-foreground"]
