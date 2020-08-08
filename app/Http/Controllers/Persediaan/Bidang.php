<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Bidang as bidangs;
use Illuminate\Support\Facades\Session;

class Bidang extends Controller
{
    //

    public function index()
    {
        $data = [
            'data'=> bidangs::all()->where('id_instansi', Session::get('id_instansi'))
        ];
        return view('Persediaan.Bidang.content', $data);
    }

    public function create(){
        return view('Persediaan.Bidang.new');
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'nama_bidang'=>'required',
            '_token'=>'required'
        ]);

        $model = new bidangs(['nama_bidang'=>$req->nama_bidang,'id_instansi'=> Session::get('id_instansi')]);

        if($model->save()){
            return redirect('bidang')->with('message_success','Anda telah menambangkan bidang baru:'.$model->nama_bidang);
        }else{
            return redirect('bidang')->with('message_error','Gagal, menambahkan bidang baru');
        }
    }

    public function edit($id){
        $model =bidangs::findOrFail($id);
        return view('Persediaan.Bidang.edit', ['data'=>$model]);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'nama_bidang'=> 'required',
            '_token'=>'required'
        ]);

        $model = bidangs::findOrFail($id);
        $model->nama_bidang = $req->nama_bidang;

        if($model->save()){
            return redirect('bidang')->with('message_success','Anda telah mengubah bidang yang anda pilih');
        }else{
            return redirect('bidang')->with('message_error','Gagal, mengubah bidang');
        }
    }

    public function destroy(Request $req, $id){
        $this->validate($req,[
            '_token'=> 'required',
            '_method'=> 'required'
        ]);

        $model = bidangs::findOrFail($id);

        if($model->delete()){
            return redirect('bidang')->with('message_success','Anda telah menghapus bidang yang anda telah pilih');
        }else{
            return redirect('bidang')->with('message_fail', 'Gagal, menghapus bidang');
        }
    }
}
