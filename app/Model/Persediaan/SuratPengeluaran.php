<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class SuratPengeluaran extends Model
{
    protected $table = 'tbl_surat_pengeluaran';

    protected $fillable = ['id_instansi','id_surat_permintaan','id_bidang','id_berwenang','nomor_surat','isi_surat','id_barang','penutup_surat','tgl_surat','title_penyedia',
        'title_jabatan','id_berwenang1','id_berwenang2'];

    public function linkToBidang(){
        return $this->belongsTo('App\Model\Persediaan\Bidang','id_bidang');
    }

    public function linkToBerwenang1(){
        return $this->belongsTo('App\Model\Persediaan\Berwenang','id_berwenang1');
    }
    public function linkToBerwenang2(){
        return $this->belongsTo('App\Model\Persediaan\Berwenang','id_berwenang2');
    }
}
