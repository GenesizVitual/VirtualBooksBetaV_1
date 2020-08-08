<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    //
    protected $table='tbl_bidang';

    protected $fillable = ['nama_bidang','id_instansi'];
}
