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
            #Query Lama
//            $query = DB::select('select * from (
//                SELECT d.id, d.nama_barang,if(d.stok-sum(tbl_pengeluaran_barang.jumlah_keluar) is null,d.stok,d.stok-sum(tbl_pengeluaran_barang.jumlah_keluar)) as stok from (
//                select tbl_gudang.id,tbl_gudang.nama_barang,sum(tbl_pembelian_barang.jumlah_barang) as stok from tbl_nota
//                join tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
//                join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
//                and tbl_gudang.id_instansi='.Session::get('id_instansi').'
//                GROUP by tbl_gudang.id
//                ) as d LEFT JOIN tbl_pengeluaran_barang on tbl_pengeluaran_barang.id_pembelian=d.id GROUP by d.id  ORDER by d.stok desc
//              ) as x where x.stok>0') ;

            $query = DB::select('select d.id, d.nama_barang,if(d.stok is null, d.jumlah_barang, sum(d.stok)) as stok from (
                            SELECT tbl_gudang.id,tbl_pembelian_barang.id as id_pembelian,tbl_nota.tgl_beli, tbl_gudang.nama_barang,tbl_pembelian_barang.jumlah_barang,tbl_pembelian_barang.satuan,tbl_pembelian_barang.harga_barang,
                            tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar) as stok
                            FROM tbl_pembelian_barang 
                            LEFT join tbl_pengeluaran_barang on tbl_pembelian_barang.id = tbl_pengeluaran_barang.id_pembelian
                            join tbl_nota on tbl_pembelian_barang.id_nota = tbl_nota.id
                            join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
                            where tbl_pembelian_barang.id_instansi = '.Session::get('id_instansi').'
                            GROUP by tbl_nota.id, tbl_gudang.id
                            ) as d GROUP by d.id ORDER by d.stok asc , d.nama_barang ASC') ;

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