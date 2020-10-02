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
    public static $status;

    public static function data_nota($array)
    {

        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);

        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        $model_nota = notas::all()->where('id_instansi',$ndata->id_instansi)
            ->where('id_thn_anggaran', $ndata->id)->sortBy('tgl_beli');

        $row = array();
        $no = 1;

        foreach ($model_nota as $data_nota)
        {
            $total_ppn = $data_nota->linkToPembelian->sum('total_ppn');
            $total_pph = $data_nota->linkToPembelian->sum('total_pph');
            $total_sebelum_pajak = $data_nota->linkToPembelian->sum('total_beli');
            $total_sesudah_pajak = $total_sebelum_pajak+$total_ppn+$total_pph;

            $column = array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($data_nota->tgl_beli));
            $column[] = RenderParsial::render_partial('Persediaan.Nota.partial.button',$data_nota, self::$status);
            $column[] = $data_nota->linkToPenyedia->penyedia;
            $column[] = number_format($total_ppn,2,',','.');
            $column[] = number_format($total_pph,2,',','.');
            $column[] = number_format($total_sebelum_pajak,2,',','.');
            $column[] = number_format($total_sesudah_pajak,2,',','.');
            $column[] = $data_nota->id;
            $column[] = $data_nota->linkToTbkNota;

            $row[] = $column;
        }

        return $row;
    }

    public static function data_pembelian_barang_per_nota()
    {

        try
        {
            $total_pph = 0;
            $total_ppn = 0;
            $nota =notas::where('id_instansi', Session::get('id_instansi'))->findOrFail(self::$id_nota);
            $row=array();
            $no=1;
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
            }
            $total_pembelian = $nota->linkToPembelian->sum('total_beli');
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