<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\LabaRugi as laba_rugi;
use App\Model\AkuntansiDagang\Bisnis;
use Session;
class LabaRugi extends Controller
{
    //

    public function LabaRugi(){
        laba_rugi::set_date_();
        laba_rugi::$kategori_jurnal = array(1);
        laba_rugi::$id_bisnis = Session::get('id_bisnis');
        $data = laba_rugi::LabaRugi('');
        return view('AkuntansiJasa.report.LabaRugi', array('data'=> $data,'judul'=> 'Laba Rugi'));
    }

    public function CetakLabaRugi(Request $req){
        laba_rugi::$begin_date_a_year = $req->tgl_awal;
        laba_rugi::$end_date_a_year = $req->tgl_akhir;
        laba_rugi::$kategori_jurnal = array(1);
        laba_rugi::$id_bisnis = Session::get('id_bisnis');
        $data = laba_rugi::LabaRugi('');
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        return view('AkuntansiJasa.report.LabaRugi_old', array('data'=> $data,'judul'=> 'Laba Rugi',
            'bisnis'=>$bisnis,
            'tgl_awal'=>$req->tgl_awal,'tgl_akhir'=>$req->tgl_akhir));
    }
}
