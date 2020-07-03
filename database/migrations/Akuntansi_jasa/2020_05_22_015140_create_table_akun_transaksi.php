<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAkunTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('akun_lv3');
            $table->enum('posisi_akun',['D','K'])->default('K');
            $table->foreignId('buku_besar_id')->references('id')->on('buku_besar')->onDelete('cascade');
            $table->foreignId('akun_id')->references('id')->on('akun')->onDelete('cascade');
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
        Schema::dropIfExists('akun_transaksi');
    }
}
