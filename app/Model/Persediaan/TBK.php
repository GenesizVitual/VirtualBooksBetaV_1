<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class TBK extends Model
{
    //
    protected $table = 'tbl_tbk';

    protected $fillable = ['id_spj','id_instansi','kode','keterangan'];

}
