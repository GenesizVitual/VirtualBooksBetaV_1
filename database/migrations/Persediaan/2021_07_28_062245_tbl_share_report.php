<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblShareReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_share_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id_instansi');
            $table->unsignedBigInteger('to_id_instansi');
            $table->foreign('from_id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
            $table->foreign('to_id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_share_report');
    }
}
