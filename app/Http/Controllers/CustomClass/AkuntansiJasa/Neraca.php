<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 23/05/2020
 * Time: 13:56
 */

namespace App\Http\Controllers\CustomClass\AkuntansiJasa;
use App\Http\Controllers\CustomClass\AkuntansiJasa\NeracaSaldo;
use App\Http\Controllers\CustomClass\AkuntansiJasa\LabaRugi as laba_rugi;
use App\Model\AkuntansiJasa\Akun;

class Neraca
{
    public static $kategori_jurnal;
    public static $id_bisnis;

    public static $begin_date_a_year;
    public static $end_date_a_year;


    public static function set_date_(){
        self::$begin_date_a_year = date('Y-01-01');
        self::$end_date_a_year = date('Y-12-31');
    }

    public static $key_laba = [
        'Akun asset'=>1,
        'Akun kewajiban'=>2,
        'Akun ekuitas'=>3,
    ];

    public static function Neraca($array){
        NeracaSaldo::$kategori_junal = self::$kategori_jurnal;
        NeracaSaldo::$begin_date_a_year = self::$begin_date_a_year;
        NeracaSaldo::$end_date_a_year= self::$end_date_a_year;
        NeracaSaldo::$id_bisnis = self::$id_bisnis;
        $data = NeracaSaldo::NeracaSaldo('');
        $data_akun = Akun::all()->where('buku_besar_id',1);
        $container = array();
        $total_laba_bersih = 0;
        foreach ($data_akun as $data_akun){
            $total_akun = 0;
            $row = array();
            foreach ($data_akun->LinkToAkunJurnalTransaksi()->get() as $data_akun_transaksi){
                if(!empty($data['data'][$data_akun_transaksi->kode])){
                    $total_akun +=$data['data'][$data_akun_transaksi->kode]['saldo_debet']+$data['data'][$data_akun_transaksi->kode]['saldo_kredit'];
                    $row[] = $data['data'][$data_akun_transaksi->kode];
                    $container[$data_akun->akun_lv2]['data'] = $row;
                    $container[$data_akun->akun_lv2]['total'] = $total_akun;
                    if($data_akun_transaksi->akun_id ==1){
                        $container[$data_akun->akun_lv2]['lv1'] = 'Aktiva';
                    }else{
                        $container[$data_akun->akun_lv2]['lv1'] = 'Passiva';
                    }
                }
            }
        }
        $new_container = self::pluck_laba_rugi($container);
        dd($new_container);
        $laba_bersih = 0;
        $container['Total']=$laba_bersih;
        return $new_container;
    }

    public static function pluck_laba_rugi($container){
        laba_rugi::$kategori_jurnal = array(1);
        laba_rugi::$id_bisnis = self::$id_bisnis;
        laba_rugi::$begin_date_a_year = self::$begin_date_a_year;
        laba_rugi::$end_date_a_year = self::$end_date_a_year;
        $data = laba_rugi::LabaRugi('');
        $plug_laba = array(
            'nama_akun'=>'Laba ditahan tahun Berjalan',
            'total_saldo'=> $data['Total']
        );
        $container['Akun ekuitas']['total'] += $data['Total'];
        array_push($container['Akun ekuitas']['data'], $plug_laba);
        return $container;
    }

}