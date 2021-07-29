<?php
namespace App\Http\Controllers\Persediaan\utils\data;
use App\Http\Controllers\Persediaan\utils\data\RincianPersediaanBarang;
use App\Model\Persediaan\KlasifikasiTBK;
class PersediaanBarangPakaiHabis
{
    public static function data(){
        $data_rincian = RincianPersediaanBarang::convertToArray();
        $container = [];
        $no = 1;
        foreach ($data_rincian as $data_item){
            $column=[];
            $column['no']=$no++;
            $column['skpd']=$data_item['instansi'];
            $klasifikasi = KlasifikasiTBK::all();
            $total = 0;
            foreach ($klasifikasi as $data_klasifikasi){
                if(!empty($data_item['data'][$data_klasifikasi->id]['total'])){
                    $n_total = $data_item['data'][$data_klasifikasi->id]['total'];
                }else{
                    $n_total = 0;
                }
                $total +=$n_total;
                $column[$data_klasifikasi->id]=number_format($n_total,2,',','.');
            }
            $column['jumlah'] =number_format($total,2,',','.');
            $container[] = $column;
        }
       return $container;
    }
}
