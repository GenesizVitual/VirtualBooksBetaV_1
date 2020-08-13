<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Persediaan\Nota;
use App\Model\Persediaan\Gudang;
use App\Model\Persediaan\PembelianBarang as pembelian;

class PembelianBarang extends Controller
{
    //

    public function show($id){
        $model = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $gudang = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
        return view('Persediaan.Pembelian.content', array('nota'=> $model,'gudang'=> $gudang));
    }

    public function store_barang(Request $req, $id_nota){

        $notas = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_nota);

        $n_req = $req->except(['_token','_method']);
        $n_req['id_instansi'] = $notas->id_instansi;
        $n_req['id_nota'] = $notas->id;
        $n_req['id_penyedia'] = $notas->id_penyedia;
        $n_req['total_beli'] = ($req->jumlah_barang*$req->harga_barang);

        $model = new pembelian($n_req);

        if($model->save()){
            return response()->json(array('status'=>true,'message'=>'Anda telah menambahkan data pembelian barang'));
        }else{
            return response()->json(array('status'=>true,'message'=>'Gagal, menambahkan data pembelian barang'));
        }
    }


}
