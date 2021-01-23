<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Model\Persediaan\Instansi;
use App\Model\Persediaan\Pembayaran;
class Invoice extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','invoice');
            $req->session()->put('sub_menu','');
            return $next($req);
        });
    }

    public function index(){
        $data =Instansi::findOrFail(Session::get('id_instansi'));
        return view('Persediaan.Invoice.content', ['data'=>$data]);
    }

    public function cetak($id){
        $model = Pembayaran::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        return view('Persediaan.Invoice.content', ['data'=>$model]);
    }
}
