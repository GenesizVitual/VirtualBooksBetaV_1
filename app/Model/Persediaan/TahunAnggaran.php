<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class TahunAnggaran extends Model
{
    //
    protected $table = 'tbl_thn_anggaran';

    protected $fillable = ['thn_anggaran','status','id_instansi'];
}
