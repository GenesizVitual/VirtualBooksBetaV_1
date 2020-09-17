<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Nota;
use App\Model\Persediaan\TahunAnggaran;

use Session;
use App\Model\Persediaan\TBK as tbl_tbk;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use App\Model\Persediaan\SPJ as tbl_spj;

class TBK extends Controller
{
    //

    public function index()
    {
        return 'TBK';
    }


    public function store(Request $req)
    {
        try{

            $this->validate($req,[
               '_token'=> 'required',
               '_method'=> 'required',
               'kode_tbk'=> 'required|unique:tbl_tbk,kode',
               'kode_temp_spj'=> 'required',
               'keterangan'=> 'required',
            ]);

            $model = new tbl_tbk();
            $model->id_spj = $req->kode_temp_spj;
            $model->id_instansi = Session::get('id_instansi');
            $model->kode = $req->kode_tbk;
            $model->keterangan = $req->keterangan;

            if($model->save())
            {
                return redirect()->back()->with('message_success','Anda telah menambahkan TBK baru dengan kode:'. $model->kode);
            }else{
                return redirect()->back()->with('message_erro','Gagal, menambahkan TBK baru');
            }

        }
        catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }

    public function edit($id){
        try{
            $model = tbl_tbk::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            return response()->json($model);
        }catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }

    public function update(Request $req, $id)
    {
        try
        {
            $this->validate($req,[
                '_token'=> 'required',
                '_method'=> 'required',
                'kode'=> 'required',
                'kode_tbk'=> 'required|unique:tbl_tbk,kode',
                'kode_temp_spj'=> 'required',
                'keterangan'=> 'required',
            ]);

            $model = tbl_tbk::findOrFail($req->kode);
            $model->id_spj = $req->kode_temp_spj;
            $model->id_instansi = Session::get('id_instansi');
            $model->kode = $req->kode_tbk;
            $model->keterangan = $req->keterangan;

            if($model->save())
            {
                return redirect()->back()->with('message_success','Anda telah mengubah TBK dengan kode:'. $model->kode);
            }else{
                return redirect()->back()->with('message_erro','Gagal, mengubah TBK baru');
            }
        }
        catch (Throwable $e)
        {
            report($e);
            return false;
        }

    }

    public function destroy(Request $req, $id)
    {
        try
        {
            $this->validate($req,[
                '_token'=> 'required',
                '_method'=> 'required'
            ]);

            $model = tbl_tbk::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            if($model->delete())
            {
                return response()->json(['status'=>'success','message'=>'Berhasil Menghapus Tanda Bukti Kas Dengan Kode '. $model->kode]);
            }else{
                return response()->json(['status'=>'error','message'=>'Gagal, Menghapus Tanda Bukti Kas dengan Kode '.$model->kode]);
            }
        }
        catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }
}
