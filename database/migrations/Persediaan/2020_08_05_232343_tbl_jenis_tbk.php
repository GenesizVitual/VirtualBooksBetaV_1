<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblJenisTbk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jenis_tbk', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('jenis_tbk');
            $table->enum('status_pembayaran', [0,1,2,3,4,5])->default('1')->comment('0=Rutin, 1=Kegiatan,2=Hibah,3=Dana Bos Pusat,4=Dana Bos Daerah, 5=Dll');
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
        Schema::dropIfExists('tbl_jenis_tbk');
    }
}
