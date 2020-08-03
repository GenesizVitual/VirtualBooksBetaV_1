<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 23/05/2020
 * Time: 10:07
 */

namespace App\Http\Controllers\Akuntansi\CustomClass\AkuntansiJasa;
use App\Http\Controllers\Akuntansi\CustomClass\AkuntansiJasa\BukuBesar;

class NeracaSaldo
{
    public static $kategori_junal;
    public static $id_bisnis;

    public static $begin_date_a_year;
    public static $end_date_a_year;


    public static function set_date_(){
        self::$begin_date_a_year = date('Y-01-01');
        self::$end_date_a_year = date('Y-12-31');
    }

    public static function NeracaSaldo($array){
        BukuBesar::$kategori_jurnal = self::$kategori_junal;
        BukuBesar::$id_bisnis = self::$id_bisnis;
        BukuBesar::$begin_date_a_year = self::$begin_date_a_year;
        BukuBesar::$end_date_a_year = self::$end_date_a_year;

        $data_buku_besar = BukuBesar::BukuBesar('');
        $container = array();
        $total_debet  = 0;
        $total_kredit = 0;
        foreach ($data_buku_besar as $key=> $data)
        {
           $total_debet += abs(end($data['data'])['saldo_debet']);
           $total_kredit += abs(end($data['data'])['saldo_kredit']);
           $container[$data['kode']] = end($data['data']);
        }
        return array('data'=> $container, 'total_debet'=>$total_debet, 'total_kredit'=> $total_kredit);
    }
}