<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 22/05/2020
 * Time: 13:08
 */

namespace App\Http\Controllers\Akuntansi\CustomClass\AkuntansiJasa;
use App\Model\AkuntansiJasa\Jurnal;



class JurnalUmum
{

    public static $total_jum_debet=0;
    public static $total_jum_kredit=0;
    public static $ketegori_jurnal;
    public static $id_bisnis;
    public static $id_jurnal;

    public static function JurnalUmum($array){
        $data = Jurnal::whereYear('tgl_transaksi',2020)->whereIn('kategori_jurnal', self::$ketegori_jurnal)->where('id_bisnis',self::$id_bisnis);
        $container = array();
        $no_urut=1;

        if(!empty(self::$id_jurnal)){
            $data->where('id', self::$id_jurnal);
        }

        foreach ($data->orderBy('id','desc')->get() as $jurnal)
        {
            $row=array();
            $row['no']= $no_urut++;
            $row['id_jurnal']= $jurnal->id;
            $row['tanggal_transaksi'] = $jurnal->tgl_transaksi;
            $row['kode'] = $jurnal->kode;
            $row['jurnal'] = $jurnal->transaksi;

            foreach ($jurnal->LinkToJurnalTransaksiAkun()->get() as $akun){
                $list_akun = array();
                $list_akun['akun_id'] = $akun->id;
                $list_akun['jurnal_id'] = $akun->jurnal_id;
                $list_akun['akun_transaksi_id'] = $akun->akun_transaksi_id;
                $list_akun['kode_akun'] = $akun->LinkToAkunTransaksi->kode;
                $list_akun['akun'] = $akun->LinkToAkunTransaksi->akun_lv3;
                $list_akun['jum_debet'] = $akun->jum_debet;
                $list_akun['jum_kredit'] = $akun->jum_kredit;

                self::sum_debet($akun->jum_debet);
                self::sum_kredit($akun->jum_kredit);
                $row['data'][] = $list_akun;
            }
            $container[] = $row;
        }
        return array('data_jurnal'=>$container, 'total_debet'=> self::$total_jum_debet,'total_kredit'=> self::$total_jum_kredit);
    }

    public static function sum_debet($jumlah_debet){
        self::$total_jum_debet += $jumlah_debet;
    }

    public static function sum_kredit($jumlah_kredit){
        self::$total_jum_kredit += $jumlah_kredit;
    }

}