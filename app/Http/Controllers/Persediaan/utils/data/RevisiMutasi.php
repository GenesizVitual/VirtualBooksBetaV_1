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
use App\Http\Controllers\Persediaan\utils\data\FormulaPajak;
use App\Model\Persediaan\Nota;

class RevisiMutasi
{
    public static $tgl_awal;
    public static $tgl_akhir;
    public static $status_penerimaan = 99;
    public static $id_barang;

    private static $row = array();
    private static $id;
    private static $stok = 0;
    private static $total = 0;

    public static function sortFunctionByDate($a, $b)
    {
        return strtotime($a["tgl"]) - strtotime($b["tgl"]);
    }

    public static function sortFunctionByID($a, $b)
    {
        return $a["id_barang"] - $b["id_barang"];
    }


    # function mutasi_barang hampir sama dengan function pengeluaran_barang yang ada di utils/data/pengeluaran barang
    public static function mutasi_barang($array)
    {

        try {
            $no = 1;
            # Cek Tahun Anggaran Akhif
            TahunAggaranCheck::tahun_anggaran_aktif([
                'id_instansi' => Session::get('id_instansi')
            ]);
            # Inisialisasi ID tahun Anggaran
            $ndata = TahunAggaranCheck::$id_thn_anggaran;


            # Jika id barang tidak kosong maka tambahkan query where id barang
            $pembelian = Nota::where('id_thn_anggaran', $ndata->id)->where('id_instansi', Session::get('id_instansi'))->orderBy('tgl_beli', 'asc');


            self::pemilahan_data_perimaan_pengeluaran($pembelian->get(), $ndata);
            # urutkan pengeluaran barang berdasarkan tanggal keluar barang
//            usort(self::$row,"self::sortFunctionByDate");
            return self::$row;
        } catch (Throwable $e) {
            return false;
        }
    }

    # Data penerimaan akan dipilah sesuai banyak pengeluaran
    public static function pemilahan_data_perimaan_pengeluaran($data_pembelian, $ndata)
    {

        foreach ($data_pembelian as $key => $data_nota) {
            foreach ($data_nota->linkToPembelian->sortBy('tgl_beli') as $data_pembelian) {
                self::$stok = 0;
                self::$total = 0;
                if (!empty(self::$id_barang)) {
                    self::daftar_mutasi_barang($data_pembelian);
                } else {
                    self::daftar_mutasi_barang($data_pembelian);
                }

            }
        }
    }

    private static function daftar_mutasi_barang($data_barang)
    {
        $column = self::colomMutasi();
        $column['tgl'] = $data_barang->linkToNota->tgl_beli;
        $column['nm_barang'] = $data_barang->linkToGudang->nama_barang;
        $column['masuk'] = number_format($data_barang->jumlah_barang, 2, ',', '.');
        $column['keluar'] = 0;
        $column['sisa'] = number_format(self::$stok, 2, ',', '.');
        self::$stok += $data_barang->jumlah_barang;
        $column['sisa_pp'] = number_format(self::$stok, 2, ',', '.');
        $column['satuan'] = $data_barang->satuan;
        $column['harga_beli'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        $column['total_penerimaan'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang * $data_barang->jumlah_barang, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        $column['total_pengeluaran'] = number_format(0, 2, ',', '.');
        $column['id_barang'] = $data_barang->id_gudang;
        $column['total'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        self::$total += ($data_barang->harga_barang * $data_barang->jumlah_barang);
        $column['total_akhir'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        self::$row[] = $column;

        foreach ($data_barang->linkToDistribusi as $data_barang_keluar) {
            $column2 = self::colomMutasi();
            $column2['sisa'] = number_format(self::$stok, 2, ',', '.');
            $column['tgl'] = $data_barang_keluar->tgl_kerluar;
            $column['nm_barang'] = $data_barang->linkToGudang->nama_barang;
            $column['masuk'] = 0;
            $column['keluar'] = number_format($data_barang_keluar->jumlah_keluar, 2, ',', '.');
            self::$stok -= $data_barang_keluar->jumlah_keluar;
            $column['satuan'] = $data_barang->satuan;
            $column['harga_beli'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
            $column['total_penerimaan'] = number_format(0, 2, ',', '.');
            $column['total_pengeluaran'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang * $data_barang_keluar->jumlah_keluar, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
            $column['sisa_pp'] = number_format(self::$stok, 2, ',', '.');
            $column['total'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
            self::$total -= ($data_barang->harga_barang * $data_barang_keluar->jumlah_keluar);
            $column['total_akhir'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
            $column['id_barang'] = $data_barang_keluar->id_gudang;

            #Menyeleksi Tanggal Barang Beli dan Tanggal Barang Keluar
            if (empty(self::$tgl_awal) && empty(self::$tgl_akhir)) {
                self::$row[] = $column;
            } else {
                self::$row[] = $column;
            }
        }
    }

    # Menghitung stok terakhir dari pembelian sebelum tahun aktif
    private static function cek_stok_terakhir($array)
    {
        $stok = DB::select('SELECT jumlah_barang,total_beli, 
                            (jumlah_barang-SUM(tbl_pengeluaran_barang.jumlah_keluar)) as stok, 
                            (jumlah_barang-SUM(tbl_pengeluaran_barang.jumlah_keluar)) * harga_barang as sisa_uang 
                            FROM tbl_pembelian_barang 
                            JOIN tbl_nota on tbl_nota.id = tbl_pembelian_barang.id_nota
                            JOIN tbl_pengeluaran_barang on tbl_pengeluaran_barang.id_pembelian = tbl_pembelian_barang.id 
                            WHERE tbl_nota.id_thn_anggaran !=' . $array['id_thn_anggaran'] . ' and tbl_nota.id_instansi =' . $array['id_instansi'] . '
                            and tbl_pembelian_barang.id_gudang = ' . $array['id_gudang'] . '
                            GROUP by tbl_pembelian_barang.id'
        );

        return $stok;
    }

    # Sediakan wadah untuk menyimpan semua data yang akan diberikan
    private static function colomMutasi()
    {
        $column = array();
        $column['sisa'] = null;
        $column['tgl'] = null;
        $column['nm_barang'] = null;
        $column['masuk'] = null;
        $column['keluar'] = null;
        $column['satuan'] = null;
        $column['harga_beli'] = null;
        $column['total_penerimaan'] = null;
        $column['total_pengeluaran'] = null;
        $column['sisa_pp'] = null;
        $column['total'] = null;
        $column['total_akhir'] = null;
        $column['id_barang'] = null;
        return $column;
    }


}