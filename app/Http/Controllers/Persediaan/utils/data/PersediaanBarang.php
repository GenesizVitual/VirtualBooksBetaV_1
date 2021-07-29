<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 23/10/2020
 * Time: 15:36
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use App\Model\Persediaan\Nota;
use Session;
use App\Http\Controllers\Persediaan\utils\data\FormulaPajak;

class PersediaanBarang
{

    public static $tgl_awal;
    public static $tgl_akhir;

    public static $status_penerimaan=99;
    public static  $row = array();
    public static  $no;

    public static function PersediaanBarang($array)
    {
        try{

            # Cek Tahun Anggaran Akhif
            TahunAggaranCheck::tahun_anggaran_aktif([
                'id_instansi'=> Session::get('id_instansi')
            ]);
            # Inisialisasi ID tahun Anggaran
            $ndata = TahunAggaranCheck::$id_thn_anggaran;

            # Data nota pembelian berdasarkan tahun anggaran
            if(!empty(self::$tgl_awal) && !empty(self::$tgl_akhir)){
                $nota = Nota::whereBetween('tgl_beli',[self::$tgl_awal,self::$tgl_akhir])->where('id_thn_anggaran', $ndata->id)
                    ->where('id_instansi', Session::get('id_instansi'))->orderBy('tgl_beli','asc')->get();
            }else{
                $nota = Nota::all()->where('id_thn_anggaran', $ndata->id)
                    ->where('id_instansi', Session::get('id_instansi'))->sortBy('tgl_beli');
            }

            # Looping Data Nota untuk mendapatkan data pembelian
            self::$no=1;
            foreach ($nota as $data_nota) {
                # tampilkan semua pembelian sesuai dgn status pembelian
                if (self::$status_penerimaan != 99) {
                    # Membuat Array Colom Pembelian Jika status pembelian sama dengan status penerimaan
                    if ($data_nota->linkToNotaBelongsToTbk->status_pembayaran == self::$status_penerimaan) {
                        self::ReListDataPembelian($data_nota);
                    }
                } elseif (self::$status_penerimaan == 99) {
                    # Membuat Array Colom Pembelian Jika status pembelian == 99 (Semua Data Pembelian)
                    self::ReListDataPembelian($data_nota);
                }
            }

          return self::$row;
        }catch (Throwable $e){
            return false;
        }
    }

    # Menyusun Colom Pembelian
    public static function ReListDataPembelian($data_nota){
        foreach ($data_nota->linkToPembelian as $data_pembelian) {
            $column = array();
            $column['no'] = self::$no++;
            $column['tanggal_pembelian'] = date('d-m-Y', strtotime($data_nota->tgl_beli));
            $column['penyedia'] = $data_nota->linkToPenyedia->penyedia;
            $column['nomor_faktur'] = '';
            $column['tgl_faktur'] = '';
            $column['nama_barang'] = $data_pembelian->linkToGudang->nama_barang;
            $column['banyak_barang'] = round($data_pembelian->jumlah_barang, 4);
            $column['harga_barang'] = round(FormulaPajak::formula_pajak($data_pembelian->harga_barang,$data_nota->ppn,$data_nota->pph), 4);
            $column['jumlah_harga'] = round(FormulaPajak::formula_pajak($data_pembelian->jumlah_barang * $data_pembelian->harga_barang,$data_nota->ppn,$data_nota->pph), 4);
            $column['BA_nomor'] = '';
            $column['BA_tanggal'] = date('d-m-Y', strtotime($data_nota->tgl_beli));
            $column['keterangan'] = $data_pembelian->keterangan;
            self::$row[] = $column;
        }
    }
}