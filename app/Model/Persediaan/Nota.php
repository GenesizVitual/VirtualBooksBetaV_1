<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table='tbl_nota';

    protected $fillable = ['kode_nota','tgl_beli','pph','ppn','id_instansi','id_thn_anggaran','id_jenis_tbk','id_penyedia'];

    public function linkToPenyedia(){
        return $this->belongsTo('App\Model\Persediaan\Penyedia','id_penyedia');
    }

    public function linkToPembelian(){
        return $this->hasMany('App\Model\Persediaan\PembelianBarang','id_nota', 'id');
    }

    public function linkToTbkNota(){
        return $this->hasOne('App\Model\Persediaan\TBK_NOTA','id_nota','id');
    }

}
