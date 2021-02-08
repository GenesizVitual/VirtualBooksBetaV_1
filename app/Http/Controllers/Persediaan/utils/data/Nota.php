<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 15/08/2020
 * Time: 11:12
 */
namespace App\Http\Controllers\Persediaan\utils\data;
use App\Model\Persediaan\Nota as notas;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use Session;
use App\Http\Controllers\Persediaan\utils\RenderParsial;

class Nota
{
    public static $id_nota;
    public static $id_jenis_nota;
    public static $status;

    public static $tgl_awal;
    public static $tgl_akhir;

    # Semua Data Nota
    public static function data_nota($array)
    {

        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);

        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        # Kalau tanggal awal dan tanggal akhir tidak kosong maka jalankan query filter data berdasarkan tanggal beli
        if(!empty(self::$tgl_awal) && !empty(self::$tgl_akhir)){
            if(!empty(self::$id_jenis_nota)) { # Seleksi id jenis tbk berdasarkan tanggal awal dan tanggal akhir
                $model_nota = notas::where('id_jenis_tbk', self::$id_jenis_nota)
                    ->whereBetween('tgl_beli', [self::$tgl_awal, self::$tgl_akhir])
                    ->where('id_instansi', $ndata->id_instansi)
                    ->where('id_thn_anggaran', $ndata->id)
                    ->orderBy('tgl_beli', 'desc')->get();
            }else{ # selain itu jalankan query default seleksi berdasarkan tanggal awal dan tanggal akhir
                $model_nota = notas::whereBetween('tgl_beli', [self::$tgl_awal, self::$tgl_akhir])
                    ->where('id_instansi', $ndata->id_instansi)
                    ->where('id_thn_anggaran', $ndata->id)
                    ->orderBy('tgl_beli', 'desc')->get();
            }
        }else{

            if(!empty(self::$id_jenis_nota)){ # Seleksi semua data berdasarkan id jenis nota
                $model_nota = notas::where('id_jenis_tbk', self::$id_jenis_nota)
                    ->where('id_instansi',$ndata->id_instansi)
                    ->where('id_thn_anggaran', $ndata->id)
                    ->orderBy('tgl_beli','desc')->get();
            }else{ # Kalau Tanggal Awal dan akhir tidak ada jalankan query defaul tampa tanggal awal dan tanggal akhir
                $model_nota = notas::all()->where('id_instansi',$ndata->id_instansi)
                    ->where('id_thn_anggaran', $ndata->id)
                    ->sortByDesc('tgl_beli');
            }
        }

        $row = array();
        $no = 1;
        foreach ($model_nota as $data_nota)
        {
            $cek_pajak = self::cek_pajak($data_nota->linkToPembelian->where('id_instansi', Session::get('id_instansi'))->sum('total_beli'), $data_nota);
            $total_sesudah_pajak = $cek_pajak->total+$cek_pajak->total_ppn+$cek_pajak->total_pph;

            $column = array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($data_nota->tgl_beli));
            $column[] = RenderParsial::render_partial('Persediaan.Nota.partial.button',$data_nota, self::$status);
            $column[] = $data_nota->linkToPenyedia->penyedia;
            $column[] = number_format($cek_pajak->total_ppn,2,',','.');
            $column[] = number_format($cek_pajak->total_pph,2,',','.');
            $column[] = number_format($cek_pajak->total,2,',','.');
            $column[] = number_format($total_sesudah_pajak,2,',','.');
            $column[] = $data_nota->id;
            $column[] = $data_nota->linkToTbkNota;
            $column[] = $total_sesudah_pajak;

            $row[] = $column;
        }

        return $row;
    }

    # Data Nota Berdasarkan id Nota
    public static function data_pembelian_barang_per_nota()
    {

        try
        {
            $total_pph = 0;
            $total_ppn = 0;
            $nota =notas::where('id_instansi', Session::get('id_instansi'))->findOrFail(self::$id_nota);
            $row=array();
            $no=1;
            $total_beli=0;
            foreach ($nota->linkToPembelian as $data)
            {
                $column = array();
                $column[] = $no++;
                $column[] = $data->linkToGudang->nama_barang;
                $column[] = number_format($data->jumlah_barang,2,',','.');
                $column[] = $data->satuan;
                $column[] = number_format($data->harga_barang,2,',','.');
                $column[] = number_format($data->total_beli,2,',','.');
                $column[] = $data->keterangan;
                $column[] = RenderParsial::render_partial('Persediaan.Pembelian.partial.button', $data);
                $row[] = $column;
                $total_beli+=$data->total_beli;
            }
//            $total_pembelian = $nota->linkToPembelian->where('id_instansi', Session::get('id_instansi'))->sum('total_beli');
            $total_pembelian = $total_beli;
            # Nilai total pajak tidak berasal dari field pph atau ppn yang ada pada tabel pembelianbarang
            $data_pajak = self::cek_pajak($total_pembelian, $nota);


            return array('data'=> $row,
                'total_beli'=>number_format(($data_pajak->total+$data_pajak->total_ppn+$data_pajak->total_pph),2,',','.'),
                'ppn'=>number_format($data_pajak->total_ppn,2,',','.'),
                'pph'=>number_format($data_pajak->total_pph,2,',','.'),
                'total_pajak'=>number_format($data_pajak->total_ppn+$data_pajak->total_pph,2,',','.'),
                'total_sebelum_bajak'=>number_format($data_pajak->total,2,',','.'),
                'terbilang'=> self::terbilang(($data_pajak->total+$data_pajak->total_ppn+$data_pajak->total_pph)),
                'nota'=> $nota
            );

        }catch (Throwable $e){
            report($e);
            return false;
        }
    }


    private static function cek_pajak($total, $model_notal){
        $total_ppn=0;
        $total_pph=0;

        if($model_notal->ppn==1){
            $total_ppn = $total*0.1;
        }

        if($model_notal->pph==1){
            $total_pph = $total*0.015;
        }

        $data_pajak = new \stdClass();
        $data_pajak->total = $total;
        $data_pajak->total_ppn = $total_ppn;
        $data_pajak->total_pph = $total_pph;

        return $data_pajak;
    }

    private static function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = self::penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = self::penyebut($nilai/10)." Puluh". self::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . self::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = self::penyebut($nilai/100) . " Ratus" . self::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . self::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = self::penyebut($nilai/1000) . " Ribu" . self::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = self::penyebut($nilai/1000000) . " Juta" . self::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = self::penyebut($nilai/1000000000) . " Milyar" . self::penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = self::penyebut($nilai/1000000000000) . " Trilyun" . self::penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    private static function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(self::penyebut($nilai));
        } else {
            $hasil = trim(self::penyebut($nilai));
        }
        return $hasil;
    }

}