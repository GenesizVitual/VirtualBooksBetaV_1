<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Instansi;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Persediaan\utils\data\Dashboard as data_dashboard;
class Dashboard extends Controller
{
    //

    public function __construct()
    {
      $this->middleware(function($req, $next){
            $req->session()->put('menu','dashboard');
            $req->session()->put('sub_menu','');
            return $next($req);
      });
    }

    public function index()
    {
        $data = [
           'instansi'=>Instansi::where('user_id', Session::get('user_id'))->first(),
           'data_rekap'=>data_dashboard::JumlahjenisTBK(null)['data_rekap'],
           'data_jenis_rekap'=>data_dashboard::data_rekap_persediaan(),
           'jumlah_perimaan'=>data_dashboard::JumlahjenisTBK(null)['total_rekap'],
           'jumlah_keluar' => data_dashboard::sumTotalPengeluaran(null)['total_pengeluaran'],
            'stok_opname'=>data_dashboard::sisa_stok(),
           'sisa_uang_pembelian' => data_dashboard::JumlahjenisTBK(null)['total_rekap']-data_dashboard::sumTotalPengeluaran(null)['total_pengeluaran']
        ];
//        dd($data['data_jenis_rekap']);
        return view('Persediaan.Dashboard.content', $data);
    }

}
