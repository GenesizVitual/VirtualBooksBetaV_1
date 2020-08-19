<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 15/08/2020
 * Time: 18:51
 */

namespace App\Http\Controllers\Persediaan\utils\data;
use App\Http\Controllers\Persediaan\utils\RenderParsial;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use View;

class PembelianBarang
{
    public static function data_pembelian($array)
    {
        //Ada Kemungkinan error butuh back tester lebih lanjut
        try {
            $query = DB::select('SELECT * from (
                                    SELECT tbl_nota.tgl_beli,tbl_gudang.nama_barang,tbl_pembelian_barang.*, tbl_pembelian_barang.jumlah_barang as stok FROM tbl_jenis_tbk 
                                    join tbl_nota on tbl_nota.id_jenis_tbk = tbl_jenis_tbk.id
                                    join tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
                                    join tbl_gudang on tbl_gudang.id = tbl_pembelian_barang.id_gudang
                                    where status_pembayaran=\''.$array['status_pembayaran'].'\' and tbl_jenis_tbk.id_instansi='.Session::get('id_instansi').'
                                    and tbl_gudang.id = '.$array['id_barang'].'
                                    order by tgl_beli asc
                                ) as d where if(d.stok >0,true,false)');

            $row = array();
            $no = 1;
            $banyaK_item=0;
            $banyaK_barang=0;
            foreach ($query as $data){
                $column = array();
                $column['no'] = $no++;
                $column['tgl_beli'] = date('d-m-Y', strtotime($data->tgl_beli));
                $column['nama_barang'] = $data->nama_barang;
                $column['stok'] = number_format($data->stok,2,',','.');
                $column['harga'] = number_format($data->harga_barang,2,',','.');
                $column['sub_total'] = number_format($data->harga_barang*$data->stok,2,',','.');
                $column['aksi'] = RenderParsial::render_partial('Persediaan.Distribusi.partial.button_pembelian', $data);
                $column['id_pembelian'] = $data->id;
                $banyaK_item ++;
                $banyaK_barang +=$data->stok;
                $row[] = $column;
            }
            return array('data'=>$row,'banyak_data'=> $banyaK_item,'banyak_barang'=> $banyaK_barang);
        }catch (Throwable $e){
            report($e);
            return false;
        }

    }
}