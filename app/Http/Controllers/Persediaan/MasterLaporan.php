<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\SettingReport;

class MasterLaporan extends Controller
{
    //
    public function index(){
       $setting = SettingReport::$report;
       return view('Persediaan.laporan.master_laporan.content',['setting_laporan'=>$setting]);
    }
}
