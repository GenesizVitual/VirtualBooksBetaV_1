<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_pembayaran', function (Blueprint $table) {
            $table->string('kode_bayar');
            $table->enum('status_bayar',['aktif','tidak_aktif'])->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
