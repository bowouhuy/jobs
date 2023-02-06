<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasaimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jasa_id');
            $table->string('filename');
            $table->string('url');
            $table->foreign('jasa_id')->references('id')->on('jasa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jasa_images');
    }
}
