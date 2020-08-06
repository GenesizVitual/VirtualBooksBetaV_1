<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Model\Persediaan\JenisTbk as jenis_tbk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class JenisTbk extends Controller
{
    //

    private $status_pembayaran = array('Rutin','Kegiatan','Hibah','Dana Bos Pusat','Dana Bos Daerah','dll');

    public function index(){
        $data = [
            'data'=> jenis_tbk::all()->where('id_instansi', Session::get('id_instansi')),
            'status_pembayaran'=> $this->status_pembayaran
        ];
        return view('Persediaan.Jenis_tbk.content', $data);
    }

    public function create(){
        $data = [
          'status_pembayaran'=>$this->status_pembayaran
        ];
        return view('Persediaan.Jenis_tbk.new', $data);
    }

    public function store(Request $req)
    {
        $this->validate($req,[
            'kode'=>'required',
            'jenis_tbk'=> 'required',
            'status_pembayaran'=>'required'
        ]);

        $new_requires = $req->except(['_token']);
        $new_requires['id_instansi']= Session::get('id_instansi');

        $model = new jenis_tbk($new_requires);
        if($model->save()){

            return redirect('jenis-tbk')->with('message_success','Anda telah menambahkan TBK Baru dengan Kode:'. $model->kode);
        }else{
            return redirect('jenis-tbk')->with('message_error','Gagal telah menambahkan TBK Baru , Silahkan periksa kembali data formulir yang dimasukan');
        }
    }

    public function edit($id){
        $data = [
            'status_pembayaran'=>$this->status_pembayaran,
            'jenis_tbk'=> jenis_tbk::where('id_instansi', Session::get('id_instansi'))->findOrFail($id)
        ];
        return view('Persediaan.Jenis_tbk.edit', $data);
    }

    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'kode'=>'required',
            'jenis_tbk'=> 'required',
            'status_pembayaran'=>'required'
        ]);

        $model = jenis_tbk::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $model->kode = $req->kode;
        $model->jenis_tbk = $req->jenis_tbk;
        $model->status_pembayaran = $req->status_pembayaran;

        if($model->save()){
            return redirect('jenis-tbk')->with('message_success','Anda telah mengubah TBK dengan Kode:'. $model->kode);
        }else{
            return redirect('jenis-tbk/'.$id.'/edit')->with('message_error','Gagal telah mengubah TBK , Silahkan periksa kembali data formulir yang dimasukan');
        }
    }

    public function destroy(Request $req, $id){
        $this->validate($req,[
            '_token'=>'required'
        ]);
        $model = jenis_tbk::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        if($model->delete()){
            return redirect('jenis-tbk')->with('message_success','Anda telah menghapus TBK dengan Kode:'. $model->kode);
        }else{
            return redirect('jenis-tbk')->with('message_error','Gagal telah menghapus TBK');
        }
    }
}
