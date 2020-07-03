<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //
    protected $table = "jurnal";

    protected $fillable = ['tgl_transaksi','kode','transaksi','kategori_jurnal','id_bisnis','id_pembelian','id_penjualan'];

    public function LinkToJurnalTransaksiAkun(){
        return $this->hasMany('App\Model\AkuntansiJasa\JurnalTransaksiAkun','jurnal_id', 'id');
    }

}
