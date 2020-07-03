<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    //
    protected $table="akun";



    public function LinkToAkunJurnalTransaksi(){
        return $this->hasMany('App\Model\AkuntansiJasa\AkunTransaksi','akun_id','id');
    }

}
