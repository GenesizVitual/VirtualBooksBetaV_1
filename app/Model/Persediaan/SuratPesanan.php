<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class SuratPesanan extends Model
{
    //
    protected $table = 'tbl_surat_pesanan';

    protected $fillable = ['id_instansi','id_nota','id_berwenang','nomor_surat','alamat','jabatan',
        'tanggal_terima','syarat','tanggal_penyelesaian','judul_penyedia','judul_jabatan'];


    # Hubungkan Surat Pesanan dengan Tabel berwenang
    public function linkToBerwenang(){
        return $this->belongsTo('App\Model\Persediaan\Berwenang','id_berwenang');
    }

}
