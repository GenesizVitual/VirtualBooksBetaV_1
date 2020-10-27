<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 25/10/2020
 * Time: 9:36
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use Session;
use App\Model\Persediaan\PembelianBarang;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use Illuminate\Support\Facades\DB;

class MutasiBarang
{
    public static $tgl_awal;
    public static $tgl_akhir;
    public static $status_penerimaan=99;

    private static $row = array();
    private static $id;

    public static function sortFunctionByDate( $a, $b ) {
        return strtotime($a["tgl"]) - strtotime($b["tgl"]);
    }

    public static function sortFunctionByID( $a, $b ) {
        return $a["id_barang"] - $b["id_barang"];
    }


    # function mutasi_barang hampir sama dengan function pengeluaran_barang yang ada di utils/data/pengeluaran barang
    public static function mutasi_barang($array){

        try{
            $no = 1;
            # Cek Tahun Anggaran Akhif
            TahunAggaranCheck::tahun_anggaran_aktif([
                'id_instansi'=> Session::get('id_instansi')
            ]);
            # Inisialisasi ID tahun Anggaran
            $ndata = TahunAggaranCheck::$id_thn_anggaran;

            # Data pembelian berdasarkan tahun anggaran
            $pembelian = PembelianBarang::all()->where('id_instansi', Session::get('id_instansi'))->groupBy('id_gudang');

            self::pemilahan_data_perimaan_pengeluaran($pembelian,$ndata );
            # urutkan pengeluaran barang berdasarkan tanggal keluar barang
            usort(self::$row,"self::sortFunctionByID");
            return self::$row;
        }catch (Throwable $e){
            return false;
        }
    }

    # Data penerimaan akan dipilah sesuai banyak pengeluaran
    public static function pemilahan_data_perimaan_pengeluaran($data_pembelian, $ndata)
    {
        foreach ($data_pembelian as $group_barang){
            $stok = 0;
            foreach ($group_barang as $data_barang){
                # Cek Data Pembelian Berdasarkan tahun nota yang sedang aktif
                if($data_barang->linkToNota->id_thn_anggaran == $ndata->id){

                    $stok += $data_barang->jumlah_barang;
                    $column = self::colomMutasi();
                    $column['tgl'] = $data_barang->linkToNota->tgl_beli;
                    $column['nm_barang'] = $data_barang->linkToGudang->nama_barang;
                    $column['masuk'] = number_format($data_barang->jumlah_barang,2,',','.');
                    $column['keluar'] = 0;
                    $column['sisa'] = $stok;
                    $column['id_barang'] = $data_barang->id_gudang;
                    self::$row[]=$column;

                    foreach ($data_barang->linkToDistribusi as $data_barang_keluar){
                        $column = self::colomMutasi();
                        $stok -= $data_barang_keluar->jumlah_keluar;
                        $column['tgl'] = $data_barang_keluar->tgl_kerluar;
                        $column['nm_barang'] = $data_barang->linkToGudang->nama_barang;
                        $column['masuk'] = 0;
                        $column['keluar'] = number_format($data_barang_keluar->jumlah_keluar,2,',','.');
                        $column['sisa'] = $stok;
                        $column['id_barang'] = $data_barang_keluar->id_gudang;
                        self::$row[]=$column;
                    }
                }
            }
        }
        return $data_pembelian;
    }

    # Menghitung stok terakhir dari pembelian sebelum tahun aktif
    private static function cek_stok_terakhir($array){
        $stok = DB::select('SELECT jumlah_barang,total_beli, 
                            (jumlah_barang-SUM(tbl_pengeluaran_barang.jumlah_keluar)) as stok, 
                            (jumlah_barang-SUM(tbl_pengeluaran_barang.jumlah_keluar)) * harga_barang as sisa_uang 
                            FROM tbl_pembelian_barang 
                            JOIN tbl_nota on tbl_nota.id = tbl_pembelian_barang.id_nota
                            JOIN tbl_pengeluaran_barang on tbl_pengeluaran_barang.id_pembelian = tbl_pembelian_barang.id 
                            WHERE tbl_nota.id_thn_anggaran !='.$array['id_thn_anggaran'].' and tbl_nota.id_instansi ='.$array['id_instansi'].'
                            and tbl_pembelian_barang.id_gudang = '.$array['id_gudang'].'
                            GROUP by tbl_pembelian_barang.id'
                );

        return $stok;
    }

    # Sediakan wadah untuk menyimpan semua data yang akan diberikan
    private static function colomMutasi(){
        $column = array();
        $column['tgl'] =null;
        $column['nm_barang'] =null;
        $column['masuk'] =null;
        $column['keluar'] =null;
        $column['sisa'] =null;
        $column['id_barang'] =null;
        return $column;
    }

    private function filter_table(){
        # Jika tgl awal dan tgl akhir kosong maka ambil semua datanya
//        if(empty(self::$tgl_awal) && empty(self::$tgl_akhir)){
//            self::$row[] = $column;
//        }else{
//            # jika tanggal awal lebih/= tgl_keluar dan tgl_akhir </= dari tgl_akhir
////                dd(strtotime($data->tgl_kerluar) < strtotime(self::$tgl_akhir));
//            if(strtotime($data->tgl_kerluar)>=strtotime(self::$tgl_awal) && strtotime($data->tgl_kerluar) <= strtotime(self::$tgl_akhir)){
//                self::$row[] = $column;
//            }
//        }
    }


}