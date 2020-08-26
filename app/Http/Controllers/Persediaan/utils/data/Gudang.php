<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 15/08/2020
 * Time: 17:12
 */

namespace App\Http\Controllers\Persediaan\utils\data;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Persediaan\utils\RenderParsial;
class Gudang
{


    //Ambil semua barang dengan penerimaan tidak habis/masih tersedia
    public static function getDataStokBarang($array){
        try
        {
            $query = DB::select('select * from (
                SELECT d.id, d.nama_barang,if(d.stok-sum(tbl_pengeluaran_barang.jumlah_keluar) is null,d.stok,d.stok-sum(tbl_pengeluaran_barang.jumlah_keluar)) as stok from (
                select tbl_gudang.id,tbl_gudang.nama_barang,sum(tbl_pembelian_barang.jumlah_barang) as stok from tbl_nota 
                join tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
                join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
                and tbl_gudang.id_instansi='.Session::get('id_instansi').'
                GROUP by tbl_gudang.id
                ) as d LEFT JOIN tbl_pengeluaran_barang on tbl_pengeluaran_barang.id_pembelian=d.id GROUP by d.id  ORDER by d.stok desc
              ) as x where x.stok>0') ;

            $row = array();
            $no=1;

            foreach ($query as $data)
            {
                $column = array();
                $column['no'] = $no++;
                $column['nama_barang'] = $data->nama_barang;
                $column['stok_barang'] = number_format($data->stok,2,',','.');
                $column['aksi'] = RenderParsial::render_partial('Persediaan.Distribusi.partial.button_gudang', $data);
                $row[] = $column;
            }

            return array('data'=> $row);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }
}