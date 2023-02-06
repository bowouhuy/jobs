<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jasa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subkategori_id');
            $table->unsignedInteger('mitra_id');
            $table->string('nama');
            $table->longtext('deskripsi');
            $table->double('rating',2,1);
            $table->foreign('subkategori_id')->references('id')->on('subkategori');
            $table->foreign('mitra_id')->references('id')->on('users');
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
        Schema::dropIfExists('jasa');
    }
}
