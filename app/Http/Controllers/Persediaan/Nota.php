<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Nota as notas;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use View;
use App\Model\Persediaan\Penyedia;
use App\Http\Controllers\Persediaan\utils\RenderParsial;

class Nota extends Controller
{
    //

    public function index()
    {
        $data = [
            'penyedia'=>Penyedia::all()->where('id_instansi', Session::get('id_instansi'))
        ];
        return view('Persediaan.Nota.content',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode_nota'=>'required|unique:tbl_nota,kode_nota',
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
            return redirect('nota')->with('message_success','Anda telah menambahkan nota pembelian baru dengan kode: '.$model->kode_nota);
        }else{
            return redirect('nota')->with('message_error','Gagal, menambahkan nota pembelian');
        }

    }

    public function data_nota_pembelian(Request $req)
    {
        $this->validate($req,[
            '_token'=> 'required'
        ]);

        TahunAggaranCheck::tahun_anggaran_aktif([
            'id_instansi'=> Session::get('id_instansi')
        ]);

        $ndata = TahunAggaranCheck::$id_thn_anggaran;

        $model_nota = notas::all()->where('id_instansi',$ndata->id_instansi)
                      ->where('id_thn_anggaran', $ndata->id)->sortBy('tgl_beli');

        $row = array();
        $no = 1;

        foreach ($model_nota as $data_nota)
        {
            $column = array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($data_nota->tgl_beli));
            $column[] = RenderParsial::render_partial('Persediaan.Nota.partial.button',$data_nota);
            $column[] = $data_nota->linkToPenyedia->penyedia;
            $column[] = $data_nota->pph;
            $column[] = $data_nota->ppn;
            $column[] = RenderParsial::render_partial('Persediaan.Nota.partial.total',$data_nota);
            $row[] = $column;
        }
        return response()->json(array('data'=>$row));
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
            'kode_nota'=>'required|unique:tbl_nota,kode_nota',
            'tgl_beli'=>'required',
            'id_penyedia'=>'required',
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
        $model->id_instansi = $ndata->id_instansi;
        $model->id_thn_anggaran = $ndata->id;

        if(!empty($req->pph)){
            $model->pph = $req->pph;
        }

        if(!empty($req->ppn)) {
            $model->ppn = $req->ppn;
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



}
