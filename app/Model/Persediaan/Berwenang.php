<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Berwenang extends Model
{
    //
    protected $table = 'tbl_berwenang';

    protected $fillable = ['id_instansi','nip','nama','jabatan'];
}
