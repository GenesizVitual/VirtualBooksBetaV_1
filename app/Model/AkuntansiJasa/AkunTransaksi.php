<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class AkunTransaksi extends Model
{
    //
    protected $table="akun_transaksi";

    protected $fillable = ['kode','akun_lv3','posisi_akun','buku_besar_id','akun_id'];

    public function LinkToAkun(){
        return $this->belongsTo('App\Model\AkuntansiJasa\Akun','akun_id');
    }
}
