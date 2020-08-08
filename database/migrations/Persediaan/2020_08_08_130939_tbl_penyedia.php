<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPenyedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_penyedia', function (Blueprint $table) {
            $table->id();
            $table->string('penyedia');
            $table->string('pimpinan');
            $table->text('alamat');
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
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
        Schema::dropIfExists('tbl_penyedia');
    }
}
