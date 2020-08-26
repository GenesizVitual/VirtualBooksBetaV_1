<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengeluaran_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_instansi')->references('id')->on('tbl_instansi')->onDelete('cascade');
            $table->foreignId('id_pembelian')->references('id')->on('tbl_pembelian_barang')->onDelete('cascade');
            $table->foreignId('id_nota')->references('id')->on('tbl_nota')->onDelete('cascade');
            $table->foreignId('id_penyedia')->references('id')->on('tbl_penyedia')->onDelete('cascade');
            $table->foreignId('id_gudang')->references('id')->on('tbl_gudang')->onDelete('cascade');
            $table->foreignId('id_bidang')->references('id')->on('tbl_bidang')->onDelete('cascade');
            $table->date('tgl_kerluar');
            $table->decimal('jumlah_keluar', 12, 2);
            $table->enum('status_pengeluaran',[0,1])->default('0')->comment('0=Non expired, 1=Expired');
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
        Schema::dropIfExists('tbl_pengeluaran');
    }
}
