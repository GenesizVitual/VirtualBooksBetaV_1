<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSuratPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surat_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
//            $table->
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
        Schema::dropIfExists('tbl_surat_pesanan');
    }
}
