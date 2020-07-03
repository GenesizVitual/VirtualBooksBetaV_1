<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\BukuBesar as buku_besar;
use App\Model\AkuntansiDagang\Bisnis;
use Session;

class BukuBesar extends Controller
{
    //
    public function buku_besar(){
        buku_besar::set_date_();
        buku_besar::$kategori_jurnal = array(1);
        buku_besar::$id_bisnis = Session::get('id_bisnis');
        $data = buku_besar::BukuBesar('');
        return view('AkuntansiJasa.report.BukuBesar', array('data'=> $data,'judul'=>'Buku Besar'));
    }


    public function cetak_buku_besar(Request $req){
        buku_besar::$begin_date_a_year = $req->tgl_awal;
        buku_besar::$end_date_a_year = $req->tgl_akhir;
        buku_besar::$kategori_jurnal = array(1);
        buku_besar::$id_bisnis = Session::get('id_bisnis');
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        $data = buku_besar::BukuBesar('');
        return view('AkuntansiJasa.report.BukuBesar_old', array('data'=> $data,'judul'=>'Buku Besar',
            'bisnis'=>$bisnis,
            'tgl_awal'=>$req->tgl_awal,'tgl_akhir'=>$req->tgl_akhir));
    }

    public function buku_besar_penyesuaian(){
        buku_besar::$kategori_jurnal = array(1,2);
        buku_besar::$id_bisnis = Session::get('id_bisnis');
        $data = buku_besar::BukuBesar('');
        return view('AkuntansiJasa.report.BukuBesar', array('data'=> $data,'judul'=>'Buku Besar Penyesuaian'));
    }
}
