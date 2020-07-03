<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\Neraca as neraca_;
use App\Model\AkuntansiDagang\Bisnis;
use Session;

class Neraca extends Controller
{
    //
    public function neraca(){
        neraca_::set_date_();
        neraca_::$kategori_jurnal = array(1);
        neraca_::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_::Neraca('');
        $data_group = $this->groupAkun($data);
        return view('AkuntansiJasa.report.Neraca', array('data'=> $data_group,'judul'=> 'Laporan Neraca'));
    }

    public function cetak_neraca(Request $req){
        neraca_::$begin_date_a_year = $req->tgl_awal;
        neraca_::$end_date_a_year= $req->tgl_akhir;
        neraca_::$kategori_jurnal = array(1);
        neraca_::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_::Neraca('');
        $data_group = $this->groupAkun($data);
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        return view('AkuntansiJasa.report.Neraca_old', array('data'=> $data_group,'judul'=> 'Neraca',
            'bisnis'=>$bisnis,
            'tgl_awal'=>$req->tgl_awal,'tgl_akhir'=>$req->tgl_akhir));
    }

    private function groupAkun($data_neraca){
        $new_array=array();
        foreach ($data_neraca as $key => $value){
            $new_array[$value['lv1']][$key] = $value;
        }
        return $new_array;
    }
}
