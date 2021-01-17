<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    //
    protected $table="tbl_instansi";

    protected $fillable=['name_instansi','singkatan_instansi','id_provinsi','id_kab_kota','alamat','no_telp','fax','email','level_instansi','logo','user_id',
        'nilai_langganan','paket_langganan','status_langganan','trial_aktif','durasi'];

    public function BelongsToProvinsi(){
        return $this->belongsTo('App\Model\Apps\Provinsi','id_provinsi');
    }

    public function BelongsToKabupatenKot(){
        return $this->belongsTo('App\Model\Apps\KotaProv','id_kab_kota');
    }

    public function LinksToUsers(){
        return $this->belongsTo('App\Model\Users','user_id');
    }

    public function LinkToTahunAnggaran(){
        return $this->hasMany('App\Model\Persediaan\TahunAnggaran','id_instansi','id');
    }
}
