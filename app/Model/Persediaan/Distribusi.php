<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    //
    protected $table = "tbl_pengeluaran_barang";

    protected $fillable = ['id_instansi','id_pembelian','id_nota','id_penyedia','id_gudang','id_bidang','tgl_kerluar','jumlah_keluar','status_pengeluaran','keterangan'];

    public function linkToGudang() {
        return $this->belongsTo('App\Model\Persediaan\Gudang','id_gudang');
    }

    public function linkToBidang(){
        return $this->belongsTo('App\Model\Persediaan\Bidang','id_bidang');
    }
}