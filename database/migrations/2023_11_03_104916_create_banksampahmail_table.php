<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksampahmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banksampahmail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUserMail');
            $table->foreign('idUserMail')->references('id')->on('useremail');
            $table->string('name');
            $table->string('email')->unique();

            // Data Bank
            $table->string('nomor', 16)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kodePos', 50)->nullable();
            $table->text('catatan')->nullable();
            $table->string('kapasitas');
            $table->string('tampung')->nullable()->default(0);
            $table->string('lang');
            $table->string('long');
            $table->rememberToken();
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
        Schema::dropIfExists('banksampahmail');
    }
}
