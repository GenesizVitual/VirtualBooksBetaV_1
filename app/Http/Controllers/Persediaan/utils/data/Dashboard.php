<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 09/01/2021
 * Time: 20:20
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;

class Dashboard
{

    #Todo: Menghitung jumlah total masih-masing pembelian barang berdasarkan jenis TBK
    public static function JumlahjenisTBK(){
        $init_thn =TahunAggaranCheck::tahun_anggaran_aktif(['id_instansi'=>Session::get('id_instansi')]);
        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        try{
            $data_query = DB::select("SELECT d.kode,d.jenis_tbk,d.id_nota, sum(d.total_beli) as total_beli, sum(d.total_ppn) as total_ppn, sum(d.total_pph) as total_pph, (sum(d.total_beli)+sum(d.total_ppn)+sum(d.total_pph)) as total_keseluruhan from (
                                              SELECT
                                                tbl_jenis_tbk.kode,
                                                tbl_jenis_tbk.jenis_tbk, 
                                                tbl_pembelian_barang.id_nota,
                                                tbl_pembelian_barang.total_beli,
                                                tbl_nota.id_jenis_tbk,
                                                if(tbl_nota.ppn='1', tbl_pembelian_barang.total_beli * 0.1, 0) as total_ppn,
                                                if(tbl_nota.pph='1', tbl_pembelian_barang.total_beli * 0.015, 0) as total_pph
                                              from tbl_nota
                                                JOIN tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
                                                JOIN tbl_jenis_tbk on tbl_nota.id_jenis_tbk = tbl_jenis_tbk.id
                                              where  tbl_nota.id_thn_anggaran = ".$ndata->id." and tbl_nota.id_instansi=".Session::get('id_instansi')."
                                            ) as d GROUP BY  d.id_jenis_tbk");
            $array = [];
            # Total Penerimaan
            $total_penerimaan = 0;
            foreach ($data_query as $data){
                 $column = [];
                 $column['kode'] = $data->kode;
                 $column['jenis_tbk'] = $data->jenis_tbk;
                 $column['total_beli'] = $data->total_beli;
                 $column['total_ppn'] = $data->total_ppn;
                 $column['total_pph'] = $data->total_pph;
                 $column['total_keseluruhan'] = $data->total_keseluruhan;
                 $total_penerimaan +=$data->total_keseluruhan;
                 $array[] = $column;
            }
            return ['data_rekap'=>$array,'total_rekap'=> $total_penerimaan];

        }catch (Throwable $e){
            return false;
        }
    }

    #Todo: Menghitung jumlah total pengeluaran + Pajak
    public static function sumTotalPengeluaran(){
        $init_thn =TahunAggaranCheck::tahun_anggaran_aktif(['id_instansi'=>Session::get('id_instansi')]);
        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        try{
            $data_query = DB::select("SELECT sum(total_sbl_pajak), sum(total_ppn), sum(total_pph), sum(total_sbl_pajak+total_ppn+total_pph) as total_pengeluaran from (
                                                   SELECT
                                                       tbl_pembelian_barang.id as id_pembelian,
                                                       tbl_nota.id_jenis_tbk,
                                                       sum(tbl_pengeluaran_barang.jumlah_keluar)*tbl_pembelian_barang.harga_barang as total_sbl_pajak,
                                                       if(tbl_nota.ppn='1', sum(tbl_pengeluaran_barang.jumlah_keluar)*tbl_pembelian_barang.harga_barang * 0.1, 0) as total_ppn,
                                                       if(tbl_nota.pph='1', sum(tbl_pengeluaran_barang.jumlah_keluar)*tbl_pembelian_barang.harga_barang * 0.015, 0) as total_pph
                                                   from tbl_nota
                                                       JOIN tbl_pembelian_barang on tbl_pembelian_barang.id_nota = tbl_nota.id
                                                       JOIN tbl_jenis_tbk on tbl_nota.id_jenis_tbk = tbl_jenis_tbk.id
                                                       JOIN tbl_pengeluaran_barang on tbl_pengeluaran_barang.id_pembelian = tbl_pembelian_barang.id
                                                   where  tbl_nota.id_thn_anggaran = ".$ndata->id." and tbl_nota.id_instansi=".Session::get('id_instansi')."
                                            ) as d");
            $array = [];
            # Total Penerimaan

            $total_pengeluaran = 0;
            if(!empty($data_query)){
                $total_pengeluaran =$data_query[0]->total_pengeluaran;
            }
            return ['total_pengeluaran'=> $total_pengeluaran];
        }catch (Throwable $e){
            return false;
        }
    }
}