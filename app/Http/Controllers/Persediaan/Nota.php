<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Nota as notas;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;

class Nota extends Controller
{
    //

    public function index()
    {
        return view('Persediaan.Nota.content');
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_nota'=>'required|unique:tbl_nota,kode_nota',
            'tgl_beli'=>'required',
        ]);

        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);

        $ndata = TahunAggaranCheck::$id_thn_anggaran;
        $new_request = $request->except('_token');
        $new_request['id_instansi'] = $ndata->id_instansi;
        $new_request['id_thn_anggaran'] = $ndata->id;
        $model = new notas($new_request);
        if($model->save()){
            return redirect('nota')->with('message_success','Anda telah menambahkan nota pembelian baru dengan kode: '.$model->kode_nota);
        }else{
            return redirect('nota')->with('message_error','Gagal, menambahkan nota pembelian');
        }

    }
}
