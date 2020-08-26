<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 17/08/2020
 * Time: 14:08
 */

namespace App\Http\Controllers\Persediaan\utils;
use App\Http\Controllers\Persediaan\utils\data\PembelianBarang;

class StatusPenerimaan
{

    public static $id_barang;

    public static function SetStatusPenerimaan()
    {
        $data = [
            '0'=> 'Rutin',
            '1'=> 'Kegiatan',
            '2'=> 'Hibah',
            '3'=> 'Dana Bos Pusat',
            '4'=> 'Dana Bos Daerah',
            '5'=> 'dll',
        ];
        return $data;
    }

    public static function DataStatusPenerimaan()
    {
        $status_penerimaan = self::SetStatusPenerimaan();
        $row = array();
        foreach ($status_penerimaan as $key => $value)
        {
            $pass = array('status_pembayaran'=> $key,'id_barang'=> self::$id_barang);
            $data = PembelianBarang::data_pembelian($pass);
            $row[] = ['judul'=> $value,'root_data'=>$data];
        }
        return $row;
    }



}