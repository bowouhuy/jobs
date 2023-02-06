<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('jasa_id');
            $table->unsignedInteger('paket_id');
            $table->double('amount',15,2);
            $table->string('kode_invoice');
            $table->date('tanggal_invoice');
            $table->date('tanggal_expired');
            $table->date('tanggal_transaksi');
            $table->string('bukti_transaksi');
            $table->enum('status',['waiting','pending','paid'])->default('waiting');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('jasa_id')->references('id')->on('jasa');
            $table->foreign('paket_id')->references('id')->on('paket');
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
        Schema::dropIfExists('transaksis');
    }
}
