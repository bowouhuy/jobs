<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userimages extends Model
{
    use HasFactory;
    protected $table = 'user_images';

    protected $fillable = [
        'user_id',
        'filename',
        'url',
    ];
}
