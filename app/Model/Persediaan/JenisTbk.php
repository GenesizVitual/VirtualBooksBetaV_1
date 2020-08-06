<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class JenisTbk extends Model
{
    //

    protected $table = "tbl_jenis_tbk";
    protected $fillable=['kode','jenis_tbk','status_pembayaran','id_instansi'];
}
