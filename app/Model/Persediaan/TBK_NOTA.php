<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class TBK_NOTA extends Model
{
    //
    protected $table = 'tbl_tbk_nota';

    protected $fillable = ['id_instansi','id_tbk','id_nota'];

    #hubungkan TBK_NOTA dengan table nota
    public function LinkToNota(){
        return $this->belongsTo('App\Model\Persediaan\Nota', 'id_nota');
    }

    #hubungkan TBK Nota Dengan table TBK
    public function LinkToTbk(){
        return $this->belongsTo('App\Model\Persediaan\TBK','id_tbk');
    }
}
