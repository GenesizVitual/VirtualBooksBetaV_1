<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomClass\AkuntansiJasa\JurnalUmum as jurnal_umum;
use Illuminate\Http\Request;
use Session;

class JurnalUmum extends Controller
{
    //

    public function JurnalUmum(){
        jurnal_umum::$ketegori_jurnal = array(1);
        jurnal_umum::$id_bisnis = Session::get('id_bisnis');
        $data = jurnal_umum::JurnalUmum('');
        return view('AkuntansiJasa.report.JurnalUmum', array('data'=>$data,'judul'=>'Jurnal Umum'));
    }

    public function JurnalPenyesuian(){
        jurnal_umum::$ketegori_jurnal = array(1,2);
        jurnal_umum::$id_bisnis = Session::get('id_bisnis');
        $data = jurnal_umum::JurnalUmum('');
        return view('AkuntansiJasa.report.JurnalUmum', array('data'=>$data, 'judul'=>'Laporan Umum Penyesuaian'));
    }

}
