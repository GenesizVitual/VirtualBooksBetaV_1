<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    protected $table = "tbl_pembayaran";

    protected $fillable = ['id_instansi','tgl_pembayaran','bukti_pembayaran','kode_bayar','status_bayar'];

    public function linkToInstansi(){
        return $this->belongsTo('App\Model\Persediaan\Instansi','id_instansi');
    }
}
