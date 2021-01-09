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
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;

class Stok
{

    public static $tgl_awal;
    public static $tgl_akhir;

    public static $id_barang;
    public static $status_penerimaan=99;

    # Function Query Stok Barang
    private static function Query($model){

        $query_segmen='';
        if(self::$status_penerimaan!='-'){
            $query_segmen .= 'and tbl_jenis_tbk.status_pembayaran='.self::$status_penerimaan;
        }

        if(self::$id_barang !='-'){
            $query_segmen .= ' and tbl_pembelian_barang.id_gudang='.self::$id_barang;
        }

        if(empty(self::$tgl_awal) && empty(self::$tgl_akhir)){
            $query = DB::select('SELECT d.id, d.nama_barang,d.satuan, d.keterangan,if(d.stok is null, d.jumlah_barang, d.stok) as stok,d.harga_barang,d.sisa_uang from(
                                    SELECT tbl_gudang.id,tbl_pembelian_barang.id as id_pembelian,tbl_nota.tgl_beli, tbl_gudang.nama_barang, tbl_pembelian_barang.satuan,tbl_pembelian_barang.jumlah_barang,tbl_pembelian_barang.keterangan,tbl_pembelian_barang.harga_barang,
                                    tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar) as stok, (tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar)) * tbl_pembelian_barang.harga_barang as sisa_uang
                                    FROM tbl_pembelian_barang 
                                    LEFT join tbl_pengeluaran_barang on tbl_pembelian_barang.id = tbl_pengeluaran_barang.id_pembelian
                                    join tbl_nota on tbl_pembelian_barang.id_nota = tbl_nota.id
                                    join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
                                    where tbl_nota.id_instansi = '.Session::get('id_instansi').' and tbl_nota.id_thn_anggaran='.$model->id.'
                                    GROUP by tbl_nota.id, tbl_gudang.id
                                    ) as d
                                ');
        }else{
             $query = DB::select('SELECT d.id, d.nama_barang,d.satuan, d.keterangan,if(d.stok is null, d.jumlah_barang, d.stok) as stok,d.harga_barang,d.sisa_uang from(
                                    SELECT tbl_gudang.id,tbl_pembelian_barang.id as id_pembelian,tbl_nota.tgl_beli, tbl_gudang.nama_barang, tbl_pembelian_barang.satuan,tbl_pembelian_barang.jumlah_barang,tbl_pembelian_barang.keterangan,tbl_pembelian_barang.harga_barang,
                                    tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar) as stok, (tbl_pembelian_barang.jumlah_barang - sum(tbl_pengeluaran_barang.jumlah_keluar)) * tbl_pembelian_barang.harga_barang as sisa_uang
                                    FROM tbl_pembelian_barang 
                                    LEFT join tbl_pengeluaran_barang on tbl_pembelian_barang.id = tbl_pengeluaran_barang.id_pembelian
                                    join tbl_nota on tbl_pembelian_barang.id_nota = tbl_nota.id
                                    join tbl_gudang on tbl_pembelian_barang.id_gudang = tbl_gudang.id
                                    join tbl_jenis_tbk on tbl_jenis_tbk.id = tbl_nota.id_jenis_tbk
                                    where tbl_nota.id_instansi = '.Session::get('id_instansi').' and tbl_nota.id_thn_anggaran='.$model->id.' and 
                                    tbl_nota.tgl_beli >= "'.self::$tgl_awal.'" and tbl_nota.tgl_beli <= "'.self::$tgl_akhir.'" '.$query_segmen.'
                                    GROUP by tbl_nota.id, tbl_gudang.id 
                                    ) as d
                                ');
        }
        return $query;
    }

    # Function yang membentuk data dari stok barang
    public static function DaftarStok($array){
        try{

            # Cek Tahun Anggaran Akhif
            TahunAggaranCheck::tahun_anggaran_aktif([
                'id_instansi'=> Session::get('id_instansi')
            ]);
            # Inisialisasi ID tahun Anggaran
            $ndata = TahunAggaranCheck::$id_thn_anggaran;


            $query = self::Query($ndata);

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