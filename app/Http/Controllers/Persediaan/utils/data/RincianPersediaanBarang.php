<?php


namespace App\Http\Controllers\Persediaan\utils\data;

use App\Http\Controllers\Persediaan\utils\data\Stok;
use App\Model\Persediaan\JenisTbk;
use http\Env\Request;
use Session;
use App\Model\Persediaan\ShareReportModel;
class RincianPersediaanBarang
{

    public static $klasifikasi;
    public static $tgl_awal;
    public static $tgl_akhir;

    public static $id_barang;
    public static $status_penerimaan = 99;
    public static $id_instansi;

    public static function filter_data($req = null)
    {
        # Inisialisasi Variable

        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            Stok::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            Stok::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
        }

        Stok::$id_barang = '-';
        Stok::$status_penerimaan = '-';


        $data_stok = Stok::DaftarStok();
        $n_container = [];
//        dd($data_stok);
        $total = 0;
        foreach ($data_stok as $item) {
            if ($item['stok_barang'] != 0) {
                $jenis_tbk = JenisTbk::find($item['id_jenis_tbk']);
                if (!empty($jenis_tbk->linkToConnectJenisTBkDanKlasifikasi)) {
                    $item['klasifikasi'] = $jenis_tbk->linkToConnectJenisTBkDanKlasifikasi->id_klasifikasi_tbk;
                } else {
                    $item['klasifikasi'] = 0;
                }

                // Menyamakan Klasifikasi Barang denga Jenis TBK
                if(!empty(self::$klasifikasi)){
                    if(self::$klasifikasi == $item['klasifikasi']){
                        $n_container[] = $item;
                    }
                }else{
                    $n_container[] = $item;
                }

            }
        }
        return $n_container;
    }

    public static function data($req = null)
    {
        $n_data = self::convertToArray($req);
        $container = [];
        $no=1;
        foreach ($n_data as $item){
            $column1 = [];
            $column1[]=$no++;
            $column1[]=$item['instansi'];
            $column1[]='';
            $column1[]='';
            $column1[]='';
            $column1[]=number_format($item['total'],2,',','.');
            $container[] = $column1;
            foreach ($item['data'] as $item2){
                foreach ($item2['data'] as $item3){
                    $column2 = [];
                    $column2[]='';
                    $column2[]=$item3['nama_barang'];
                    $column2[]=$item3['satuan'];
                    $column2[]=$item3['stok_barang'];
                    $column2[]=number_format($item3['harga_barang'],2,',','.');
                    $column2[]=number_format($item3['total'],2,',','.');
                    $container[] = $column2;
                }
            }
        }
        return $container;
    }

    public static function convertToArray($req=null){
        $data = ShareReportModel::where('to_id_instansi', Session::get('id_instansi'))->get();
        $container = [];
        foreach ($data as $item){
            Stok::$id_instansi = $item->from_id_instansi;
            $column = [];
            $column['instansi']= $item->linkToFromInstance->name_instansi;
            $column['data']= self::group_by_instansi($req);
            $column['total']=self::calculate_total_klasifikasi($req);
            $container[]=$column;
        }
        return $container;
    }

    private static function calculate_total_klasifikasi($req){
        $data = self::group_by_instansi($req);
        $total =0;
        foreach ($data as $item){
            $total +=$item['total'];
        }
        return $total;
    }

    private static function group_by_instansi($req)
    {
        $n_data = self::filter_data($req);
        $group_data = self::_group_by($n_data, 'klasifikasi');
        $proccedd_data = self::sum_total_by_klasifikasi($group_data);
        return $proccedd_data;
    }

    private static function sum_total_by_klasifikasi($array)
    {
        $container = [];
        foreach ($array as $key => $item) {
            $total = 0;
            foreach ($item['data'] as $value) {
                $total += $value['total'];
            }
            $item['total'] = $total;
            $container[$key] = $item;
        }

        return $container;
    }

    private static function _group_by($array, $key)
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val[$key]]['data'][] = $val;
        }
        return $return;
    }
}
