<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nota', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nota',100)->unique();
            $table->date('tgl_beli');
            $table->enum('pph',[0,1])->default('0')->comment('0=aktif, 1=tidak aktif');
            $table->enum('ppn',[0,1])->default('0')->comment('0=aktif, 1=tidak aktif');
            $table->foreignId('id_thn_anggaran')->references('id')->on('tbl_thn_anggaran')->onDelete('cascade');
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
            $table->foreignId('id_jenis_tbk')->references('id')->on('tbl_jenis_tbk')->onDelete('cascade');
            $table->foreignId('id_penyedia')->references('id')->on('tbl_penyedia')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_nota');
    }
}
