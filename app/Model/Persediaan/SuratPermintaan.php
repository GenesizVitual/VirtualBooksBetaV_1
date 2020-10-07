<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class SuratPermintaan extends Model
{
    //

    protected $table = 'tbl_surat_permintaan_barang';

    protected $fillable = ['id_bidang','id_berwenang','nomor_surat','isi_surat','id_barang','penutup_surat','tgl_surat','title_penyedia',
        'title_jabatan','id_berwenang1','id_berwenang2'];

    public function linkToBerwenang1(){
        return $this->belongsTo('App\Model\Persediaan\Berwenang','id_berwenang1');
    }
    public function linkToBerwenang2(){
        return $this->belongsTo('App\Model\Persediaan\Berwenang','id_berwenang2');
    }
}
