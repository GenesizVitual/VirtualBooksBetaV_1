<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kotaprov', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('level',['kabupaten','kota'])->default('kabupaten');
            $table->foreignId('provinsi_id')->references('id')->on('provinsi')->onDelete('cascade');
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
        Schema::dropIfExists('kotaprov');
    }
}
