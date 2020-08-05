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
        Schema::create('tbl_instansi', function (Blueprint $table) {
            $table->id();
            $table->string('name_instansi');
            $table->string('singkatan_instansi');
            $table->foreignId('id_provinsi')->references('id')->on('provinsi')->onDelete('cascade');
            $table->foreignId('id_kab_kota')->references('id')->on('kotaprov')->onDelete('cascade');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->enum('level_instansi',['0','1','2'])->comment('0=Provinsi, 1=Kabupaten, 2=Kota');
            $table->string('logo')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_instansi');
    }
}
