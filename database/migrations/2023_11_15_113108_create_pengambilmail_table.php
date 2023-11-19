<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilmail', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // Data Pengambil
            $table->string('berat');
            $table->string('namaLengkap', 100)->nullable();
            $table->string('nomor', 16)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kota', 50)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kodePos', 50)->nullable();
            $table->string('bank', 50);
            $table->string('atasNamaBank');
            $table->text('norek');
            $table->string('ewallet', 50)->nullable();
            $table->string('namaewallet')->nullable();
            $table->text('noewallet')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('pengambilmail');
    }
}
