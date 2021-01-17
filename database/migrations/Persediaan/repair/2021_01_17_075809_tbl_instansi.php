<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblInstansi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_instansi', function (Blueprint $table) {
            $table->integer('nilai_langganan')->default(0);
            $table->enum('paket_langganan',['-','1','2','3','4'])->default('-')->comment('1=paket 1, 2=paket 2, 3=paket 3, 4=paket 4');
            $table->enum('status_langganan',['true','false'])->default('false')->comment('false = belum berlangganan, true=berlangganan');
            $table->enum('trial_aktif',['true','false'])->default('true')->comment('true = trial aktif, false=trial tidak aktif');
            $table->date('durasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_instansi', function (Blueprint $table) {
            //
        });
    }
}
