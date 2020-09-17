<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class TBK extends Model
{
    //
    protected $table = 'tbl_tbk';

    protected $fillable = ['id_spj','id_instansi','kode','keterangan'];

    #Menghubungkan tbk dan nota melalui model TBK_NOTA
    public function LinkToNota_via_TBK_Nota(){
        return $this->hasMany('App\Model\Persediaan\TBK_NOTA','id_tbk','id');
    }

}
