<?php
namespace App\Http\Controllers\Persediaan\utils;
use App\Model\Persediaan\TahunAnggaran;

class TahunAggaranCheck
{

    public static $id_thn_anggaran;

    public static function tahun_anggaran_aktif($array){
        $model = TahunAnggaran::where('id_instansi',$array['id_instansi'])->where('status','1')->first();
        self::$id_thn_anggaran=$model;
    }

}