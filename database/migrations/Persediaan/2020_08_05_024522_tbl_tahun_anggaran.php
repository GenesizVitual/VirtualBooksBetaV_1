<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTahunAnggaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_thn_anggaran', function (Blueprint $table) {
            $table->id();
            $table->year('thn_anggaran');
            $table->enum('status',['0','1'])->default('0')->comment('0=tidak aktif, 1=aktif');
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_thn_anggaran');
    }
}
