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
            $table->foreignId('id_nota')->references('id')->on('tbl_nota')->onDelete('cascade');
            $table->foreignId('id_berwenang')->references('id')->on('tbl_berwenang')->onDelete('cascade');
            $table->string('nomor_surat',100)->unique();
            $table->string('alamat')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tanggal_terima');
            $table->date('tanggal_penyelesaian');
            $table->string('judul_penyedia');
            $table->string('judul_jabatan');
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
