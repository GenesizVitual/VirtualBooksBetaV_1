<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\data\Nota;
use App\Model\Persediaan\Berwenang;

class SuratPesanan extends Controller
{
    //
    public function index(){

    }

    public function show($id_nota){
        try{
            Nota::$id_nota = $id_nota;
            $data_nota = Nota::data_pembelian_barang_per_nota();
//            dd($data_nota);
            $data_nota['berwenang'] = Berwenang::all()->where('id_instansi', Session::get('id_instansi'));
            return view('Persediaan.Surat.SuratPesanan.content', $data_nota);
        }catch (Throwable $e){
            return $e;
        }
    }
}
