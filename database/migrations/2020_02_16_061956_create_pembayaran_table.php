<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('waktu_pembayaran');
            $table->bigInteger('jumlah');
            $table->bigInteger('id_petugas')->unsigned()->nullable();
            $table->bigInteger('id_siswa')->unsigned()->nullable();
            $table->foreign('id_petugas')->references('id')->on('users');
            $table->foreign('id_siswa')->references('id')->on('siswa');
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
        Schema::dropIfExists('pembayaran');
    }
}
