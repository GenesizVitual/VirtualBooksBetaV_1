<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class TBK_NOTA extends Model
{
    //
    protected $table = 'tbl_tbk_nota';

    protected $fillable = ['id_instansi','id_tbk','id_nota'];

}
