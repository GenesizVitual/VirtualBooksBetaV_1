<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    //

    protected $table="tbl_pembelian_barang";

    protected $fillable = ['id_instansi','id_nota','id_penyedia','id_gudang','jumlah_barang','satuan','harga_barang','tanggal_expired','total_beli','keterangan'];


}
