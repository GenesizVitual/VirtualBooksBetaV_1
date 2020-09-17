<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
    protected $table='tbl_nota';

    protected $fillable = ['kode_nota','tgl_beli','pph','ppn','id_instansi','id_thn_anggaran','id_jenis_tbk','id_penyedia'];

    # Hubungkan Nota dengan Penyedia
    public function linkToPenyedia(){
        return $this->belongsTo('App\Model\Persediaan\Penyedia','id_penyedia');
    }

    # Hubungkan Nota Dengan Data Pembelian
    public function linkToPembelian(){
        return $this->hasMany('App\Model\Persediaan\PembelianBarang','id_nota', 'id');
    }

    # Hubungkan Nota Dengan Data Group TBK Dan Nota
    public function linkToTbkNota(){
        return $this->hasOne('App\Model\Persediaan\TBK_NOTA','id_nota','id');
    }

}
