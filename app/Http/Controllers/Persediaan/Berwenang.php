<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Berwenang as tbl_berwenang;
use Session;

class Berwenang extends Controller
{
    //

    public function index()
    {
        $data = [
            'data'=>tbl_berwenang::all()->where('id_instansi')
        ];
        return view('Persediaan.Berwenang.content', $data);
    }

    public function create()
    {
        return view('Persediaan.Berwenang.new');
    }

    public function store(Request $req)
    {
        try{
            $this->validate($req,[
                'nip'=> 'required|unique:tbl_berwenang,nip',
                'nama'=> 'required',
                'jabatan'=> 'required',
            ]);

            $model = new tbl_berwenang();
            $model->id_instansi = Session::get('id_instansi');
            $model->nip = $req->nip;
            $model->nama = $req->nama;
            $model->jabatan = $req->jabatan;

            if($model->save()){
                return redirect()->back()->with('message_success',$model->nama.' Telah berhasil ditambahkan');
            }else{
                return redirect()->back()->with('message_error',$req->nama.' gagal ditambahkan');
            }
        }catch (Throwable $e){
            return false;
        }
    }

    public function show($id){
        try
        {
            $model = tbl_berwenang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            return response()->json($model);
        }catch (Throwable $e){
            return false;
        }
    }


    public function edit($id){
        try
        {
            $model = tbl_berwenang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            return view('Persediaan.Berwenang.edit', ['data'=> $model]);
        }catch (Throwable $e){
            return false;
        }
    }

    public function update(Request $req, $id)
    {
        try{
            $this->validate($req,[
                'nip'=> 'required|unique:tbl_berwenang,nip',
                'nama'=> 'required',
                'jabatan'=> 'required',
            ]);

            $model = tbl_berwenang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            $model->id_instansi = Session::get('id_instansi');
            $model->nip = $req->nip;
            $model->nama = $req->nama;
            $model->jabatan = $req->jabatan;

            if($model->save()){
                return redirect()->back()->with('message_success',$model->nama.' Telah berhasil diubah');
            }else{
                return redirect()->back()->with('message_error',$req->nama.' gagal diubah');
            }
        }catch (Throwable $e){
            return false;
        }
    }

    public function destroy(Request $req, $id){
        try{
            $model = tbl_berwenang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            if($model->delete()){
                return redirect()->back()->with('message_success',$model->nama.' Telah berhasil dihapus');
            }else{
                return redirect()->back()->with('message_error',$req->nama.' gagal dihapus');
            }
        }catch (Throwable $e){
            return false;
        }
    }
}
