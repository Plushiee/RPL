<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPemilik');
            $table->foreign('idPemilik')->references('id')->on('useremail');
            $table->string('jenisSampah');
            $table->string('nama');
            $table->string('nomor');
            $table->string('berat');
            $table->text('catatanTambahan')->nullable();
            $table->string('bukti')->nullable();
            $table->boolean('approved');
            $table->boolean('terkirim');
            $table->string('bankSampah')->nullable();
            $table->string('alamat')->nullable();
            $table->string('lang')->nullable();
            $table->string('long')->nullable();
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
        Schema::dropIfExists('transaksi_bank');
    }
}
