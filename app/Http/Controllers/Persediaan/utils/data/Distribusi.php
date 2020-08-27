<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 21/08/2020
 * Time: 14:20
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use App\Model\Persediaan\Bidang;
use App\Http\Controllers\Persediaan\utils\RenderParsial;
use Session;
use App\Model\Persediaan\PembelianBarang;
use Illuminate\Support\Facades\DB;
class Distribusi
{

    public static $status_keluar = [
      'Non Expired',
      'Expired',
    ];

    public static function data_distribusi($array){
        try{
            $id_pembelian = $array['kode'];
            $model_pembelian = PembelianBarang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_pembelian);
            $no = 1;
            $row = array();
            foreach ($model_pembelian->linkToDistribusi as $data_distribusi)
            {
                $column = array();
                $column[] = $no++;
                $column[] = $data_distribusi->linkToBidang->nama_bidang;
                $column[] = date('d-m-Y', strtotime($data_distribusi->tgl_kerluar));
                $column[] = $data_distribusi->jumlah_keluar;
                $column[] = self::$status_keluar[$data_distribusi->status_pengeluaran];
                $column[] = $data_distribusi->keterangan;
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.button_distribusi', $data_distribusi);
                $row[] = $column;
            }
            return array('data_form'=> $row,'tgl_beli'=>$model_pembelian->linkToNota->tgl_beli);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }


}