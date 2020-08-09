<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    //

    protected $table = "tbl_gudang";

    protected $fillable= ['nama_barang','id_instansi'];
}
