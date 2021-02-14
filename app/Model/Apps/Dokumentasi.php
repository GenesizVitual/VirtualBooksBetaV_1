<?php

namespace App\Model\Apps;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    //
    protected $table = 'tbl_documentasi';

    protected $fillable = ['no_urut','judul','konten'];
}
