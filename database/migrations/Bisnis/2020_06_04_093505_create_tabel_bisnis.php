<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelBisnis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bisnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bisnis');
            $table->text('alamat');
            $table->foreignId('provinsi_id')->references('id')->on('provinsi')->onDelete('cascade');
            $table->foreignId('kotaprov_id')->references('id')->on('kotaprov')->onDelete('cascade');
            $table->enum('jenis_bisnis', ['JASA','DAGANG'])->default('DAGANG');
            $table->bigInteger('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('logo');
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
        Schema::dropIfExists('bisnis');
    }
}
