<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\NeracaSaldo as neraca_saldo;
use App\Model\AkuntansiDagang\Bisnis;
use Session;
class NeracaSaldo extends Controller
{
    //
    public function NeracaSaldo(){
        neraca_saldo::set_date_();
        neraca_saldo::$kategori_junal = array(1);
        neraca_saldo::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo', array('data'=>$data, 'judul'=>'Neraca Saldo'));
    }

    public function CetakNeracaSaldo(Request $req){
        neraca_saldo::$begin_date_a_year = $req->tgl_awal;
        neraca_saldo::$end_date_a_year = $req->tgl_akhir;
        neraca_saldo::$kategori_junal = array(1);
        neraca_saldo::$id_bisnis = Session::get('id_bisnis');
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo_old', array('data'=>$data, 'judul'=>'Neraca Saldo',
            'bisnis'=>$bisnis,
            'tgl_awal'=>$req->tgl_awal,'tgl_akhir'=>$req->tgl_akhir));
    }

    public function NeracaSaldoPenyesuaian(){
        neraca_saldo::$kategori_junal = array(1,2);
        neraca_saldo::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo',  array('data'=>$data, 'judul'=>'Neraca Saldo Penyesuaian'));
    }
}
