<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class JenisTbk extends Model
{
    //

    protected $table = "tbl_jenis_tbk";
    protected $fillable=['kode','jenis_tbk','status_pembayaran','id_instansi'];

    public function linkToConnectJenisTBkDanKlasifikasi(){
        return $this->hasOne('App\Model\Persediaan\ConnectJenisTBKdanKlasfikasi','id_jenis_tbk','id');
    }
}
