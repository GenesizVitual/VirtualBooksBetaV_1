<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table='tbl_nota';

    protected $fillable = ['kode_nota','tgl_beli','pph','ppn','id_instansi','id_thn_anggaran'];
}
