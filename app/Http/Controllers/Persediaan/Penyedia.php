<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Penyedia as penyedias;
use Illuminate\Support\Facades\Session;

class Penyedia extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','data_master');
            $req->session()->put('sub_menu','penyedia');
            return $next($req);
        });
    }


    public function  index()
    {
        $data = [
            'data'=> penyedias::all()->where('id_instansi', Session::get('id_instansi'))
        ];
        return view('Persediaan.Penyedia.content', $data);
    }

    public function create()
    {
        return view('Persediaan.Penyedia.new');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'penyedia'=>'required',
            'pimpinan'=>'required',
            'alamat'=>'required'
        ]);

        $model = new penyedias();
        $model->penyedia = $req->penyedia;
        $model->pimpinan = $req->pimpinan;
        $model->alamat = $req->alamat;
        $model->no_telp = $req->no_fax;
        $model->id_instansi = Session::get('id_instansi');

        if($model->save()){
            return redirect('penyedia')->with('message_success','Anda telah menambahkan penyedia :'. $model->penyedia);
        }else{
            return redirect('penyedia')->with('message_error','Gagal, menambahkan data penyedia');
        }
    }

    public function edit($id)
    {
        $data = [
            'data'=> penyedias::where('id_instansi', Session::get('id_instansi'))->findOrFail($id)
        ];

        return view('Persediaan.Penyedia.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'penyedia'=>'required',
            'pimpinan'=>'required',
            'alamat'=>'required'
        ]);

        $model = penyedias::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $model->penyedia = $req->penyedia;
        $model->pimpinan = $req->pimpinan;
        $model->alamat = $req->alamat;
        $model->no_telp = $req->no_telp;
        $model->no_fax = $req->no_fax;
        $model->id_instansi = Session::get('id_instansi');

        if($model->save()){
            return redirect('penyedia')->with('message_success','Anda telah mengubah penyedia :'. $model->penyedia);
        }else{
            return redirect('penyedia')->with('message_error','Gagal, menambahkan data penyedia');
        }

    }

    public function destroy(Request $req, $id)
    {
        $this->validate($req,[
            '_method'=>'required',
            '_token'=>'required',
        ]);
        $model = penyedias::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        if($model->delete()){
            return redirect('penyedia')->with('message_success','Anda telah menghapus penyedia :'. $model->penyedia);
        }else{
            return redirect('penyedia')->with('message_error','Gagal, menambahkan data penyedia');
        }

    }
}
