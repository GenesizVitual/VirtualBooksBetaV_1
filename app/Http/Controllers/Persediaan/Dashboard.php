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
            'data_rekap'=>data_dashboard::JumlahjenisTBK(null)
        ];

        return view('Persediaan.Dashboard.content', $data);
    }

}
