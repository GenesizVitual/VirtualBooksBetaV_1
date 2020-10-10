<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSuratPengeluara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_surat_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
            $table->foreignId('id_surat_permintaan')->references('id')->on('tbl_surat_permintaan_barang')->onDelete('cascade');
            $table->foreignId('id_bidang')->references('id')->on('tbl_bidang')->onDelete('cascade');
            $table->foreignId('id_berwenang')->references('id')->on('tbl_berwenang')->onDelete('cascade');
            $table->string('nomor_surat',100)->unique();
            $table->date('tgl_permintaan_barang');
            $table->text('isi_surat');
            $table->string('id_barang');
            $table->text('penutup_surat');
            $table->date('tgl_surat');
            $table->string('title_penyedia');
            $table->string('title_jabatan');
            $table->foreignId('id_berwenang1')->references('id')->on('tbl_berwenang')->onDelete('cascade');
            $table->foreignId('id_berwenang2')->references('id')->on('tbl_berwenang')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_surat_pengeluaran');
    }
}
