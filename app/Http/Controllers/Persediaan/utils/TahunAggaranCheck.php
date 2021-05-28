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

    public static function DateToConvert($date){
        $date = explode('-', $date);
        $tgl = $date[0];
        $bulan = $date[1];
        $tahun = $date[2];
        $romawi = "";
        if($bulan == "01"){
            $romawi = "I";
        }elseif ($bulan == "02"){
            $romawi = "II";
        }elseif ($bulan == "03"){
            $romawi = "III";
        }elseif ($bulan == "04"){
            $romawi = "IV";
        }elseif ($bulan == "05"){
            $romawi = "V";
        }elseif ($bulan == "06"){
            $romawi = "VI";
        }elseif ($bulan == "07"){
            $romawi = "VII";
        }elseif ($bulan == "08"){
            $romawi = "VIII";
        }elseif ($bulan == "09"){
            $romawi = "IX";
        }elseif ($bulan == "10"){
            $romawi = "X";
        }elseif ($bulan == "11"){
            $romawi = "XI";
        }elseif ($bulan == "12"){
            $romawi = "XII";
        }
        return $romawi;
    }

}