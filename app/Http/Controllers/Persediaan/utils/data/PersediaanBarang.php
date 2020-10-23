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

class PersediaanBarang
{

    public static $tgl_awal;
    public static $tgl_akhir;

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
                    ->where('id_instansi', Session::get('id_instansi'))->get();
            }else{
                $nota = Nota::all()->where('id_thn_anggaran', $ndata->id)
                    ->where('id_instansi', Session::get('id_instansi'))->sortBy('tgl_beli');
            }

            $row = array();
            $no = 1;

            # Looping Data Nota untuk mendapatkan data pembelian
            foreach ($nota as $data_nota){

                # Looping Data pembelian dari nota
                foreach ($data_nota->linkToPembelian as $data_pembelian){
                    $column = array();
                    $column['no'] = $no++;
                    $column['tanggal_pembelian'] = date('d-m-Y', strtotime($data_nota->tgl_beli));
                    $column['penyedia'] = $data_nota->linkToPenyedia->penyedia;
                    $column['nomor_faktur'] = '';
                    $column['tgl_faktur'] = '';
                    $column['nama_barang'] = $data_pembelian->linkToGudang->nama_barang;
                    $column['banyak_barang'] = round($data_pembelian->jumlah_barang,4);
                    $column['harga_barang'] = round($data_pembelian->harga_barang,4);
                    $column['jumlah_harga'] = round($data_pembelian->jumlah_barang*$data_pembelian->harga_barang,4);
                    $column['BA_nomor'] = '';
                    $column['BA_tanggal'] = date('d-m-Y', strtotime($data_nota->tgl_beli));
                    $column['keterangan'] = $data_pembelian->keterangan;
                    $row[] = $column;
                }
            }

          return $row;
        }catch (Throwable $e){
            return false;
        }
    }
}