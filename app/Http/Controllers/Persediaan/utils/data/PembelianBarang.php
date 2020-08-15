<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 15/08/2020
 * Time: 18:51
 */

namespace App\Http\Controllers\Persediaan\utils\data;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PembelianBarang
{
    public static function data_pembelian($array)
    {
        $query = DB::select('SELECT * from (
                                SELECT tbl_nota.tgl_beli,tbl_gudang.nama_barang,tbl_pembelian_barang.*, tbl_pembelian_barang.jumlah_barang as stok FROM tbl_jenis_tbk 
                                join tbl_nota on tbl_nota.id_jenis_tbk = tbl_jenis_tbk.id
                                join tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
                                join tbl_gudang on tbl_gudang.id = tbl_pembelian_barang.id_gudang
                                where status_pembayaran=\''.$array['status_pembayaran'].'\' and tbl_jenis_tbk.id_instansi='.Session::get('id_instansi').'
                                order by tgl_beli asc
                            ) as d where if(d.stok >0,stok,0)');

        $row = array();
        $no = 1;
        foreach ($query as $data){
            $column = array();
            $column['no'] = $no++;
            $column['id_pembelian'] = $data->id;
            $column['tgl_beli'] = $data->tgl_beli;
            $column['nama_barang'] = $data->nama_barang;
            $column['stok'] = $data->stok;
            $column['aksi'] = '';
            $row[] = $column;
        }
        return $row;
    }
}