<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPemilik');
            $table->unsignedBigInteger('idPengambil')->nullable();
            $table->foreign('idPemilik')->references('id')->on('useremail');
            $table->foreign('idPengambil')->references('id')->on('pengambilmail');
            $table->string('jenisSampah');
            $table->string('nama');
            $table->string('nomor');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->integer('kodePos');
            $table->text('catatan')->nullable();
            $table->string('berat');
            $table->string('bukti')->nullable();
            $table->string('buktibayar')->nullable();
            $table->boolean('diterima')->default(false);;
            $table->boolean('terbayar');
            $table->boolean('approved');
            $table->boolean('terambil');
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
        Schema::table('user_transaksi', function (Blueprint $table) {
            $table->dropForeign(['idPemilik']);
        });

        Schema::dropIfExists('user_transaksi');
    }
}
