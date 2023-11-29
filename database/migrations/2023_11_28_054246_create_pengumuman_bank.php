<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanBank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman_bank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idBank')->nullable();
            $table->foreign('idBank')->references('id')->on('banksampahmail');
            $table->date('tanggal');
            $table->string('judulPengumuman');
            $table->string('isiPengumuman');
            $table->boolean('aktif')->default(true);
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
        Schema::dropIfExists('pengumuman_bank');
    }
}
