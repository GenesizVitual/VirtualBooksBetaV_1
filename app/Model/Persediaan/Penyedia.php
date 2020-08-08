<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    //

    protected $table = 'tbl_penyedia';
    protected $fillable = ['penyedia','pimpinan','alamat','no_telp','no_fax','id_instansi'];

}
