<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\TahunAnggaran as thn_anggaran;
use Illuminate\Support\Facades\Session;
class TahunAnggaran extends Controller
{
    //


    public function index()
    {
        $data = [
            'tahun_anggaran'=> thn_anggaran::where('id_instansi', Session::get('id_instansi'))->orderBy('thn_anggaran','asc')->paginate(10)
        ];
        return view('Persediaan.Tahun_Anggaran.content', $data);
    }

    public function store(Request $req){
        $this->validate($req,[
            'thn_anggaran'=>'required|numeric'
        ]);

        $model = new thn_anggaran([
            'thn_anggaran'=> $req->thn_anggaran,
            'id_instansi'=>Session::get('id_instansi')
        ]);

        if($model->save()){
            return redirect('tahun-anggaran')->with('message_success','Anda telah menambah data tahun anggaran');
        }else{
            return redirect('tahun-anggaran')->with('message_error','Gagal menambahkan tahun anggaran baru');
        }
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'thn_anggaran'=>'required|numeric',
            'status'=>'required'
        ]);

        $model = thn_anggaran::findOrFail($id);
        $model->thn_anggaran = $req->thn_anggaran;
        $model->status = $req->status;

        if($model->save()){
            thn_anggaran::whereNotIn('id',[$id])->where('id_instansi', Session::get('id_instansi'))->update(['status'=>'0']);
            return redirect('tahun-anggaran')->with('message_success','Anda telah mengubah data tahun anggaran');
        }else{
            return redirect('tahun-anggaran')->with('message_error','Gagal mengubah data tahun anggaran');
        }
    }

    public function destroy(Request $req, $id){
        $this->validate($req,[
            '_token'=> 'required',
            '_method'=> 'required'
         ]);

        $model = thn_anggaran::findOrFail($id);

        if($model->delete())
        {
            return response()->json(array('status'=>'success','message'=>'Anda telah menghapus data tahun anggaran ini'));
        }else{
            return response()->json(array('status'=>'error','message'=>'Gagal menghapus data tahun anggaran'));
        }
    }
}
