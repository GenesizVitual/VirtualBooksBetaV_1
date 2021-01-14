<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Model\Persediaan\Gudang as gudangs;
use App\Imports\GudangImport;
use Excel;


class Gudang extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','data_master');
            $req->session()->put('sub_menu','gudang');
            return $next($req);
        });
    }

    public function index(){
        $data = [
            'data'=>gudangs::all()->where('id_instansi', Session::get('id_instansi'))
        ];
        return view('Persediaan.Gudang.content', $data);
    }


    public function create(){
        return view('Persediaan.Gudang.new');
    }

    public function store(Request $req){

        $this->validate($req,[
           'nama_barang'=> 'required',
           '_token'=>'required'
        ]);

        $model= new gudangs();
        $model->nama_barang = $req->nama_barang;
        $model->id_instansi = Session::get('id_instansi');

        if ($model->save()){
            return redirect('gudang')->with('message_success','Anda telah menambahkan data barang :'.$model->nama_barang.' ke gudang');
        }else{
            return redirect('gudang')->with('message_error','Gagal, menambahkan data barang ke gudang');
        }
    }

    public function edit($id){
        $id = Crypt::decrypt($id);
        $model = gudangs::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $data = [
            'data'=> $model
        ];
        return view('Persediaan.Gudang.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $id = Crypt::decrypt($id);
        $this->validate($req,[
            'nama_barang'=> 'required',
            '_token'=>'required'
        ]);

        $model= gudangs::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $model->nama_barang = $req->nama_barang;
        $model->id_instansi = Session::get('id_instansi');

        if ($model->save()){
            return redirect('gudang')->with('message_success','Anda telah mengubah data barang menjadi :'.$model->nama_barang.' ke gudang');
        }else{
            return redirect('gudang')->with('message_error','Gagal, mengubah data barang ke gudang');
        }
    }

    public function destroy(Request $req, $id){
        $id = Crypt::decrypt($id);
        $this->validate($req,[
            '_token'=> 'required',
            '_method'=>'required'
        ]);

        $model= gudangs::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        if ($model->delete()){
            return redirect('gudang')->with('message_success','Anda telah menghapus data barang:'.$model->nama_barang.' yang ada di gudang');
        }else{
            return redirect('gudang')->with('message_error','Gagal, menghapus data barang ke gudang');
        }
    }

    public function data_gudang(){
        $model = gudangs::all()->where('id_instansi', Session::get('id_instansi'));
        return response()->json(array('data'=>$model));
    }

    public function import(Request $req){
         $this->validate($req,[
            'file' => 'required|mimes:csv,xls,xlsx|max:2048'
        ]);
        if ($req->hasFile('file')) {
            $file = $req->file('file');
            Excel::import(new GudangImport, $file);
            return redirect()->back()->with(['message_success' => 'Import data barang selesai']);
        }
        return redirect()->back()->with(['message_info' => 'Pastikan file barang sesaui dengan format']);
    }
}
