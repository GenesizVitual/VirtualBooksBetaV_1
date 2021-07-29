<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblJenisTBKDanKlasifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_connect_jenis_tbk_dan_klasifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_klasifikasi_tbk');
            $table->unsignedBigInteger('id_jenis_tbk');
            $table->foreign('id_klasifikasi_tbk')->references('id')->on('tbl_klasifikasitbks')->onDelete('restrict');
            $table->foreign('id_jenis_tbk')->references('id')->on('tbl_jenis_tbk')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_connect_jenis_tbk_dan_klasifikasi');
    }
}
