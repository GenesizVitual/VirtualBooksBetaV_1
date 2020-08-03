<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 22/05/2020
 * Time: 14:13
 */

namespace App\Http\Controllers\Akuntansi\CustomClass\AkuntansiJasa;
use App\Model\AkuntansiJasa\JurnalTransaksiAkun;
use Illuminate\Support\Facades\DB;

class BukuBesar
{

    public static $total_saldo_debet=0;
    public static $total_saldo_kredit=0;
    public static $total_debet=0;
    public static $total_kredit=0;
    public static $kategori_jurnal;
    public static $id_bisnis;

    public static $begin_date_a_year;
    public static $end_date_a_year;


    public static function set_date_(){
        self::$begin_date_a_year = date('Y-01-01');
        self::$end_date_a_year = date('Y-12-31');
    }


    public static function operasiSaldo($data){

        //Jika Posisi Saldo = Posisi Akun
        if($data->LinkToAkunTransaksi->LinkToAkun->posisi_saldo == $data->LinkToAkunTransaksi->posisi_akun){
            //saldo debet
            if($data->LinkToAkunTransaksi->posisi_akun=="D"){
                if($data->jum_debet !=0 && $data->jum_kredit==0)
                {
                    self::$total_saldo_debet += $data->jum_debet;
                }else{
                    self::$total_saldo_debet -= $data->jum_kredit;
                }
             //saldo kredit
            }else{
                if($data->jum_debet ==0 && $data->jum_kredit!=0)
                {
                    self::$total_saldo_kredit += $data->jum_kredit;
                }else{
                    self::$total_saldo_kredit -= $data->jum_debet;
                }
            }
            //Jika Posisi Saldo != Posisi Akun
        }else{
            //saldo debet
            if($data->LinkToAkunTransaksi->posisi_akun=="D"){
                if($data->jum_debet !=0 && $data->jum_kredit==0)
                {
                    self::$total_saldo_debet -= $data->jum_debet;
                }else{
                    self::$total_saldo_debet += $data->jum_kredit;
                }
                //saldo kredit
            }else{
                if($data->jum_debet ==0 && $data->jum_kredit!=0)
                {
                    self::$total_saldo_kredit -= $data->jum_kredit;
                }else{
                    self::$total_saldo_kredit += $data->jum_debet;
                }
            }
        }
    }


    public static function BukuBesar($array){
        $data = JurnalTransaksiAkun::all()
            ->where('tgl_jurnal','=',2020)
            ->whereBetween('tgl_jurnal',[self::$begin_date_a_year, self::$end_date_a_year])
            ->whereIn('kategori_jurnal',self::$kategori_jurnal)
            ->sortBy('tgl_jurnal')
            ->where('id_bisnis', self::$id_bisnis)
            ->groupBy('akun_transaksi_id');


        $container=array();
        foreach ($data as $key => $akun){
            self::$total_saldo_debet=0;
            self::$total_saldo_kredit=0;
            self::$total_debet=0;
            self::$total_kredit=0;
            foreach ($akun as $data_akun){
               self::operasiSaldo($data_akun);
               $row = array();
               $row['tanggal_jurnal']= $data_akun->LinkToJurnal->tgl_transaksi;
               $row['nomor_transaksi']= $data_akun->LinkToJurnal->kode;
               $row['keterangan']= $data_akun->LinkToJurnal->transaksi;
               $row['kode']= $data_akun->LinkToAkunTransaksi->kode;
               $row['nama_akun']= $data_akun->LinkToAkunTransaksi->akun_lv3;
               $row['debet']= $data_akun->jum_debet;
               $row['kredit']= $data_akun->jum_kredit;
               $row['saldo_debet']= self::$total_saldo_debet;
               $row['saldo_kredit']= self::$total_saldo_kredit;
               $row['total_saldo'] = self::$total_saldo_debet + self::$total_saldo_kredit;
               self::$total_debet +=$data_akun->jum_debet;
               self::$total_kredit +=$data_akun->jum_kredit;
               $container[$key]['data'][]= $row;
               $container[$key]['kode']= $data_akun->LinkToAkunTransaksi->kode;
               $container[$key]['nama_akun']= $data_akun->LinkToAkunTransaksi->akun_lv3;
               $container[$key]['total_debet']= self::$total_debet;
               $container[$key]['total_kredit']= self::$total_kredit;
            }
        }
         return $container;
    }
}