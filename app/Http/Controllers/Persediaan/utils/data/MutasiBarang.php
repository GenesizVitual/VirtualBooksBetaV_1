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

class MutasiBarang
{
    public static $tgl_awal;
    public static $tgl_akhir;
    public static $status_penerimaan = 99;
    public static $id_barang;

    private static $row = array();
    private static $id;
    private static $stok = 0;
    private static $total = 0;
    private static $stok_penerimaan = 0;
    private static $total_penerimaan = 0;
    private static $uraian;
    private static $no_urut = 1;
    public static $klasifikasi_persediaan;

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

            if (!empty(self::$tgl_awal) && !empty(self::$tgl_akhir)) {
                $nota = Nota::whereBetween('tgl_beli', [self::$tgl_awal, self::$tgl_akhir])->where('id_thn_anggaran', $ndata->id)->where('id_instansi', Session::get('id_instansi'));
            } else {
                $nota = Nota::where('id_thn_anggaran', $ndata->id)->where('id_instansi', Session::get('id_instansi'));
            }

            foreach ($nota->orderBy('tgl_beli', 'asc')->get() as $item_nota) {
                if (!empty(self::$klasifikasi_persediaan)) {
                    if (!empty($item_nota->linkToNotaBelongsToTbk->linkToConnectJenisTBkDanKlasifikasi)) {
                        if ($item_nota->linkToNotaBelongsToTbk->linkToConnectJenisTBkDanKlasifikasi->id_klasifikasi_tbk == self::$klasifikasi_persediaan) {
                            self::pemilahan_data_perimaan_pengeluaran($item_nota->linkToPembelian->groupBy('id_gudang'), $item_nota->status_stok);
                        }
                    }
                } else {
                    self::pemilahan_data_perimaan_pengeluaran($item_nota->linkToPembelian->groupBy('id_gudang'), $item_nota->status_stok);
                }
            }

            return self::$row;
        } catch (Throwable $e) {
            return false;
        }
    }

    # Data penerimaan akan dipilah sesuai banyak pengeluaran
    public static function pemilahan_data_perimaan_pengeluaran($data_pembelian, $status_stok)
    {
        //Perulangan group dengan id barang yang sama
        foreach ($data_pembelian as $key => $group_barang) {
            self::$stok = 0;
            self::$total = 0;

            # Data group looping untuk mendapatkan data pembelian
            foreach ($group_barang as $sub_key => $data_barang) {
                if ($status_stok == '1') {
                    self::$stok = $data_barang->jumlah_barang;
                    self::$total = $data_barang->total_beli;
                    self::$stok_penerimaan = 0;
                    self::$uraian = 'Saldo Awal Persediaan';
                    self::$total_penerimaan = 0;
                } else {
                    self::$stok_penerimaan = $data_barang->jumlah_barang;
                    self::$total_penerimaan = $data_barang->total_beli;
                    self::$uraian = 'Terima dari toko ' . $data_barang->linkToNota->linkToPenyedia->penyedia;
                    self::$stok = 0;
                    self::$total = 0;
                }
                # Cek Data Pembelian Berdasarkan tahun nota yang sedang aktif
                if (self::$status_penerimaan != 99) { #cek status penerimaan selain status penerimaan 99
                    # memisahkan data pembelian berdasarkan status pembanyaran
                    if ($data_barang->linkToNota->linkToNotaBelongsToTbk->status_pembayaran == self::$status_penerimaan) {
                        self::daftar_mutasi_barang($data_barang);
                    }
                } else {
                    if (!empty(self::$id_barang)) {
                        if (!empty(self::$id_barang == $data_barang->id_gudang)) {
                            self::daftar_mutasi_barang($data_barang);
                        };
                    } else {
                        self::daftar_mutasi_barang($data_barang);
                    }
                }
            }
        }
    }

    private static function daftar_mutasi_barang($data_barang)
    {
        $column = self::colomMutasi();
        $column['no_urut'] = self::$no_urut;
        self::$no_urut += 1;
        $column['tgl'] = $data_barang->linkToNota->tgl_beli;
        $column['nm_barang'] = $data_barang->linkToGudang->nama_barang;
        $column['no_nota'] = $data_barang->linkToNota->kode_nota;
        $column['uraian'] = self::$uraian;
        self::$uraian = 'Terima barang dari ' . $data_barang->linkToNota->linkToPenyedia->penyedia;
        $column['bukti'] = 'BAST';
        $column['masuk'] = number_format(self::$stok_penerimaan, 2, ',', '.');
        $column['keluar'] = 0;
        $column['sisa'] = number_format(self::$stok, 2, ',', '.');
        self::$stok += self::$stok_penerimaan;
        $column['sisa_pp'] = number_format(self::$stok, 2, ',', '.');
        $column['satuan'] = $data_barang->satuan;
        $column['harga_beli'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
//        $column['total_penerimaan'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang * $data_barang->jumlah_barang, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        $column['total_penerimaan'] = number_format(FormulaPajak::formula_pajak($data_barang->harga_barang * self::$stok_penerimaan, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        $column['total_pengeluaran'] = number_format(0, 2, ',', '.');
        $column['id_barang'] = $data_barang->id_gudang;
        $column['total'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        self::$total += ($data_barang->harga_barang * self::$stok_penerimaan);
        $column['total_akhir'] = number_format(FormulaPajak::formula_pajak(self::$total, $data_barang->linkToNota->ppn, $data_barang->linkToNota->pph), 2, ',', '.');
        self::$row[] = $column;

        foreach ($data_barang->linkToDistribusi as $data_barang_keluar) {
            $column = self::colomMutasi();
            $column['no_urut'] = '';
            $column['sisa'] = number_format(self::$stok, 2, ',', '.');
            $column['tgl'] = $data_barang_keluar->tgl_kerluar;
            $column['uraian'] = 'Pengambilan oleh ' . $data_barang_keluar->linkToBidang->nama_bidang;
            $column['no_nota'] = '';
            $column['bukti'] = '';
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
