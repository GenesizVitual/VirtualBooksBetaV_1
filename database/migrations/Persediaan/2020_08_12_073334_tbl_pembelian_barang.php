<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPembelianBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pembelian_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
            $table->foreignId('id_nota')->references('id')->on('tbl_nota')->onDelete('cascade');
            $table->foreignId('id_penyedia')->references('id')->on('tbl_penyedia')->onDelete('cascade');
            $table->foreignId('id_gudang')->references('id')->on('tbl_gudang')->onDelete('cascade');
            $table->decimal('jumlah_barang',12,4)->unsigned();
            $table->string('satuan')->nullable();
            $table->decimal('harga_barang',12,4)->unsigned();
            $table->date('tanggal_expired');
            $table->decimal('total_beli',12,4)->unsigned();
            $table->decimal('total_ppn',12,4)->unsigned();
            $table->decimal('total_pph',12,4)->unsigned();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('tbl_pembelian_barang');
    }
}
