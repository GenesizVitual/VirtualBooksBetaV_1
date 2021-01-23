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
        $uud =$this->unique_code(5);
        return view('Persediaan.Invoice.invoice_print', ['data'=>$model, 'uid'=>$uud,'tanggal'=>date('d/m/Y')]);
    }

    function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

}
