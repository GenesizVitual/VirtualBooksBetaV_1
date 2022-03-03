<?php

namespace App\Http\Controllers\Persediaan\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Gudang;
use Illuminate\Support\Facades\Auth;

class TestBarang extends Controller
{
    //
    public function index(){
        $data = Gudang::where('id_instansi',1)->get();
        return response()->json($data, 200);
    }
    
    public function store(Request $req){
        $this->validate($req,[
            'nama_barang'=> 'required',
            'id_instansi'=> 'required'
        ]);
        $data = new Gudang($req->all());
        $data->save();
        return response()->json($data, 200);
    }
    
    public function update(Request $req, $id){
        $this->validate($req,[
            'nama_barang'=> 'required',
            'id_instansi'=> 'required'
        ]);
        $data = Gudang::find($id);
        $data->update($req->all());
        return response()->json($data, 200);
    }  
    
    public function destroy(Request $req, $id){
        $data = Gudang::find($id);
        $data->delete();
        return response()->json($data, 200);
    }


    public function barangAuth(){
        $data = "produk owner:". Auth::user()->getAuthIdentifierName();
        return response()->json($data, 200);
    }
}
