<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 18/11/2020
 * Time: 16:17
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use Illuminate\Support\Facades\DB;
use Session;

class Stok
{

    # Function yang membentuk data dari stok barang
    public static function DaftarStok($array){
        try{
            $query = DB::select('SELECT d.id, d.nama_barang,d.satuan, d.keterangan,if(d.stok is null, d.jumlah_barang, d.stok) as stok,d.harga_barang,d.sisa_uang from(
                                SELECT tbl_gudang.id,tbl_pembelian_barang.id as id_pembelian,tbl_nota.tgl_beli, tbl_gudang.nama_barang, tbl_pembelian_barang.satuan,tbl_pembelian_barang.jumlah_barang,tbl_pembelian_barang.keterangan,tbl_pembelian_barang.harga_barang,
                                tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar) as stok, (tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar)) * tbl_pembelian_barang.harga_barang as sisa_uang
                                FROM tbl_pembelian_barang 
                                LEFT join tbl_pengeluaran_barang on tbl_pembelian_barang.id = tbl_pengeluaran_barang.id_pembelian
                                join tbl_nota on tbl_pembelian_barang.id_nota = tbl_nota.id
                                join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
                                where tbl_nota.id_instansi = '.Session::get('id_instansi').'
                                GROUP by tbl_nota.id, tbl_gudang.id
                                ) as d
                            ');

            $row = [];
            foreach ($query as $data){
                $column=[];
                $column['nama_barang']= $data->nama_barang;
                $column['satuan']= $data->satuan;
                $column['stok_barang']= $data->stok;
                $column['harga_barang']= $data->harga_barang;
                $column['keterangan']= $data->keterangan;
                $row[] = $column;
            }

            return $row;
        }catch (Throwable $e){
            return false;
        }
    }
}