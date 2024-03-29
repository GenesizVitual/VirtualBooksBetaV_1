<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Persediaan\utils\data\FormulaPajak;
use Illuminate\Http\Request;
use App\Model\Persediaan\Nota as notas;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use View;
use App\Model\Persediaan\Penyedia;
use App\Http\Controllers\Persediaan\utils\data\Nota as data_nota;
use App\Model\Persediaan\JenisTbk;
use App\Model\Persediaan\Instansi;


class Nota extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','nota');
            $req->session()->put('sub_menu','');
            return $next($req);
        });
    }

    # Todo Penentuan Kode Nota
    private function Kode_Nota(){
        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);
        $data_thn_anggaran = TahunAggaranCheck::$id_thn_anggaran;

        $model_nota = notas::where('id_instansi', Session::get('id_instansi'))
            ->where('id_thn_anggaran', $data_thn_anggaran->id)->count('id');
        $model_instansi = Instansi::find(Session::get('id_instansi'));
        $current_date = date('d-m-Y');
        $romawi = TahunAggaranCheck::DateToConvert($current_date);

        $kode_nota =0;
        if($model_nota<10){
            $kode_nota = '0'.($model_nota+1).'/NP/'.$model_instansi->singkatan_instansi.'/'.$romawi.'/'.$data_thn_anggaran->thn_anggaran;
        }else{
            $kode_nota = ($model_nota+1).'/NP/'.$model_instansi->singkatan_instansi.'/'.$romawi.'/'.$data_thn_anggaran->thn_anggaran;
        }
        return $kode_nota;
    }


    public function index()
    {
        $data = [
            'penyedia'=>Penyedia::all()->where('id_instansi', Session::get('id_instansi')),
            'jenis_tbk'=> JenisTbk::all()->where('id_instansi', Session::get('id_instansi')),
            'kode_nota'=> $this->Kode_Nota(),
            'pajak' => FormulaPajak::$pajak
        ];
        return view('Persediaan.Nota.content',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_nota'=>'required',
            'tgl_beli'=>'required',
            'id_penyedia'=>'required',
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
            return redirect('pembelian-barang/'.$model->id)->with('message_success','Anda telah menambahkan nota pembelian baru dengan kode: '.$model->kode_nota);
        }else{
            return redirect('nota')->with('message_error','Gagal, menambahkan nota pembelian');
        }

    }

    public function edit_nota(Request $req, $id)
    {
        $this->validate($req,[
            '_token'=> 'required'
        ]);
        $model = notas::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        return response()->json(array('data'=> $model));
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'kode_nota'=>'required',
            'tgl_beli'=>'required',
            'id_penyedia'=>'required',
            'id_jenis_tbk'=>'required',
            '_token'=>'required',
        ]);

        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);

        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        $model = notas::where('id_instansi', $ndata->id_instansi)->findOrFail($id);
        $model->kode_nota = $req->kode_nota;
        $model->tgl_beli = $req->tgl_beli;
        $model->id_penyedia = $req->id_penyedia;
        $model->id_jenis_tbk = $req->id_jenis_tbk;
        $model->id_instansi = $ndata->id_instansi;
        $model->id_thn_anggaran = $ndata->id;

        if(!empty($req->pph)){
            $model->pph = $req->pph;
        }else{
            $model->pph = 0;
        }

        if(!empty($req->ppn)) {
            $model->ppn = $req->ppn;
        }else{
            $model->ppn = 0;
        }

         if($model->save()){
            return redirect('nota')->with('message_success','Anda telah mengubah nota pembelian dengan kode: '.$model->kode_nota);
        }else{
            return redirect('nota')->with('message_error','Gagal, mengubah nota pembelian');
        }
    }

    public function destroy(Request $req, $id)
    {
        $this->validate($req,[
            '_token'=>'required',
            '_method'=>'required'
        ]);

        $model = notas::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);

        if($model->delete()){
            return response()->json(array('status'=>true,'message'=>'Anda telah menghapus nota dengan kode:'. $model->kode_nota));
        }else{
            return response()->json(array('status'=>false,'message'=>'Gagal, menghapus nota'));
        }
    }

    public function data_nota_pembelian(Request $req)
    {
        $this->validate($req,[
            '_token'=> 'required'
        ]);

        $row = data_nota::data_nota(null);
        return response()->json(array('data'=>$row));
    }

    public function cetak_nota($id)
    {
        data_nota::$id_nota = $id;
        $data = data_nota::data_pembelian_barang_per_nota();
        return view('Persediaan.Nota.report.print_page', $data);
    }
}
