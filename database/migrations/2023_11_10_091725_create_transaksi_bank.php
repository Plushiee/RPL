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
            $table->unsignedBigInteger('idBank')->nullable();
            $table->foreign('idPemilik')->references('id')->on('useremail');
            $table->foreign('idBank')->references('id')->on('banksampahmail');

            $table->string('jenisSampah');
            $table->string('nama');
            $table->string('nomor');
            $table->text('catatanTambahan')->nullable();
            $table->string('berat');
            $table->string('bukti')->nullable();
            $table->boolean('diterima')->default(false);
            $table->boolean('terantar');
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
