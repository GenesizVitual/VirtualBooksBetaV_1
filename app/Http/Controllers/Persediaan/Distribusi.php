<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Model\Persediaan\Bidang;
use App\Http\Controllers\Persediaan\utils\data\Distribusi as data_form_distribusi;
use App\Http\Controllers\Persediaan\utils\data\Gudang;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\StatusPenerimaan;
use App\Model\Persediaan\Gudang as tbl_gudang;
class Distribusi extends Controller
{
    //

    public function index()
    {
        $data = Gudang::getDataStokBarang(null);

        return view('Persediaan.Distribusi.content', $data);
    }

    public function show($id)
    {
        StatusPenerimaan::$id_barang = $id;
        $data =StatusPenerimaan::DataStatusPenerimaan();
        $bidang = Bidang::all()->where('id_instansi', Session::get('id_instansi'));
        $gudang = tbl_gudang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        return view('Persediaan.Distribusi.tab.content', array('data'=>$data,'gudang'=>$gudang,'bidang'=>$bidang));
    }

    public function form_distribusi(Request $request){
        $this->validate($request,[
            '_token'=> 'required',
            '_method'=> 'required',
            'kode'=> 'required' //id_pembelian
        ]);
        $data = data_form_distribusi::form_data_distribusi(null);
        $data['id_pembelian']=$request->kode;
        return response()->json($data);
    }
}
