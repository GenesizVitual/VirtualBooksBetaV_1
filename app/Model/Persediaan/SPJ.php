<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    //
    protected $table = 'tbl_spj';

    protected $fillable = ['id_instansi','id_thn_anggaran','kode'];

    public function linkToTbk(){
        return $this->hasMany('App\Model\Persediaan\TBK','id_spj','id');
    }
}
