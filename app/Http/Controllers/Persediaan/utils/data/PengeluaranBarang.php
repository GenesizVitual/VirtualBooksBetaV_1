<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 24/10/2020
 * Time: 9:52
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use Session;
use App\Model\Persediaan\Nota;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use App\Http\Controllers\Persediaan\utils\data\FormulaPajak;

class PengeluaranBarang
{
    public static $tgl_awal;
    public static $tgl_akhir;
    public static $status_penerimaan=99;
    public static $tahun;

    private static $row = array();
    private static $id;


    public static function sortFunction( $a, $b ) {
        return strtotime($a["tanggal_keluar"]) - strtotime($b["tanggal_keluar"]);
    }

    public static function pengeluaran_barang($array){

        try{
            $no = 1;
            # Cek Tahun Anggaran Akhif
            TahunAggaranCheck::tahun_anggaran_aktif([
                'id_instansi'=> Session::get('id_instansi')
            ]);
            # Inisialisasi ID tahun Anggaran
            $ndata = TahunAggaranCheck::$id_thn_anggaran;
            self::$tahun = $ndata->thn_anggaran;
            # Data nota pembelian berdasarkan tahun anggaran
            $nota = Nota::all()->where('id_thn_anggaran', $ndata->id)
                ->where('id_instansi', Session::get('id_instansi'))->sortBy('tgl_beli');

            # Exrat data pengeluaran dari data nota
            foreach ($nota as $data_nota)
            {

                if (self::$status_penerimaan != 99) {
                    # Membuat Array Colom Pembelian Jika status pembelian sama dengan status penerimaan
                    if ($data_nota->linkToNotaBelongsToTbk->status_pembayaran == self::$status_penerimaan) {
                        self::ColumnDataPengeluaran($data_nota);
                    }
                } elseif (self::$status_penerimaan == 99) {
                    # Membuat Array Colom Pembelian Jika status pembelian == 99 (Semua Data Pembelian)
                    self::ColumnDataPengeluaran($data_nota);
                }
            }
            # urutkan pengeluaran barang berdasarkan tanggal keluar barang
            usort(self::$row,"self::sortFunction");

            return self::$row;
        }catch (Throwable $e){
            return false;
        }
    }

    # column data pengeluaran
    public static function ColumnDataPengeluaran($data_nota)
    {
        foreach ($data_nota->linkToPengeluaranBarang as $data){
            $column = array();
            # Data Penerimaan
            $column['tanggal_terima'] =$data->linkToPembelian->linkToNota->tgl_beli;
            $column['penyedia'] =$data->linkToSupplier->penyedia;
            $column['no_faktur'] ='';
            $column['tgl_faktur'] ='';
            $column['jenis_surat'] ='';
            $column['no_surat_faktur'] ='';
            $column['satuan'] = $data->linkToPembelian->satuan;
            $column['thn_pembuatan'] = '';
            $column['sp'] = '';
            # Data Berita Acara
            $column['tgl_BA'] = '';
            $column['nomor_BA'] = '';
            $column['keterangan_pem'] = $data->linkToPembelian->linkToNota->keterangan;
            # Data Surat Bon
            $column['tgl_bon'] = '';
            $column['nomor_bon'] = '';
            # Data Pengeluaran
            $column['tanggal_keluar'] =$data->tgl_kerluar;
            $column['nama_barang'] =$data->linkToGudang->nama_barang;
            $column['banyak_barang'] =$data->jumlah_keluar;
            $column['harga_satuan'] =number_format(FormulaPajak::formula_pajak($data->linkToPembelian->harga_barang,$data_nota->ppn,$data_nota->pph),2,',','.');
            $column['jumlah_harga'] =number_format(round(FormulaPajak::formula_pajak($data->jumlah_keluar*$data->linkToPembelian->harga_barang,$data_nota->ppn,$data_nota->pph),2),2,',','.');
            $column['bidang'] =$data->linkToBidang->nama_bidang;
            $column['tanggal_penyerahan'] =$data->tgl_kerluar;
            $column['keterangan'] =$data->keterangan;

            # Jika tgl awal dan tgl akhir kosong maka ambil semua datanya
            if(empty(self::$tgl_awal) && empty(self::$tgl_akhir)){
                self::$row[] = $column;
            }else{
                # jika tanggal awal lebih/= tgl_keluar dan tgl_akhir </= dari tgl_akhir
//                dd(strtotime($data->tgl_kerluar) < strtotime(self::$tgl_akhir));
                if(strtotime($data->tgl_kerluar)>=strtotime(self::$tgl_awal) && strtotime($data->tgl_kerluar) <= strtotime(self::$tgl_akhir)){
                    self::$row[] = $column;
                }
            }
        }
    }



}