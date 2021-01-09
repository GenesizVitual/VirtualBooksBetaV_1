<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use App\Model\Persediaan\SPJ as tbl_spj;

class SPJ extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','spj-tbk');
            $req->session()->put('sub_menu','');
            return $next($req);
        });
    }

    public function index()
    {
        try{
            $array = [
                'id_instansi'=> Session::get('id_instansi')
            ];

            TahunAggaranCheck::tahun_anggaran_aktif($array);
            $tahun_anggaran =TahunAggaranCheck::$id_thn_anggaran;

            $model = tbl_spj::all()->where('id_instansi',$tahun_anggaran->id_instansi)->where('id_thn_anggaran', $tahun_anggaran->id);
            return view('Persediaan.SpjTBK.content', ['data'=> $model]);
        }catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }

    public function store(Request $req)
    {
        try{
            $this->validate($req,[
                'kode_spj'=> 'required|unique:tbl_spj,kode',
                '_method'=> 'required'
            ]);

            $array = [
                'id_instansi'=> Session::get('id_instansi')
            ];

            TahunAggaranCheck::tahun_anggaran_aktif($array);
            $tahun_anggaran_aktiv = TahunAggaranCheck::$id_thn_anggaran;

            $model = new tbl_spj();
            $model->id_instansi = Session::get('id_instansi');
            $model->id_thn_anggaran = $tahun_anggaran_aktiv->id;
            $model->kode = $req->kode_spj;

            if($model->save()){
                return redirect()->back()->with('message_success','Surat Pertanggung Jawaban Berhasil Dibuat Dengan Kode :'. $model->kode);
            }else{
                return redirect()->back()->with('message_error','Surat Pertanggung Jawaban Gagal Dibuat');
            }

        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function edit($id)
    {
        try{

            $model = tbl_spj::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            return response()->json($model);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function update(Request $req, $id)
    {

        try{
            $this->validate($req,[
                'kode_spj'=> 'required|unique:tbl_spj,kode',
                '_method'=> 'required',
                'kode'=> 'required'
            ]);

            $array = [
                'id_instansi'=> Session::get('id_instansi')
            ];

            TahunAggaranCheck::tahun_anggaran_aktif($array);
            $tahun_anggaran_aktiv = TahunAggaranCheck::$id_thn_anggaran;

            $model = tbl_spj::findOrFail($req->kode);
            $model->id_instansi = Session::get('id_instansi');
            $model->id_thn_anggaran = $tahun_anggaran_aktiv->id;
            $model->kode = $req->kode_spj;

            if($model->save()){
                return redirect()->back()->with('message_success','Surat Pertanggung Jawaban Berhasil Diubah Dengan Kode :'. $model->kode);
            }else{
                return redirect()->back()->with('message_error','Surat Pertanggung Jawaban Gagal Diuab');
            }

        }catch (Throwable $e){
            report($e);
            return false;
        }

    }

    public function destroy(Request $req, $id)
    {
        try{
            $this->validate($req,[
                '_method'=> 'required',
                '_token'=> 'required',
            ]);

            $modal = tbl_spj::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            if($modal->delete()){
                return response()->json(['status'=>'success','message'=>'Berhasil Menghapus Surat Pertanggung Jawaban Dengan Kode'. $modal->kode]);
            }else{
                return response()->json(['status'=>'error','message'=>'Gagal, menghapus data spj']);
            }
        }catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }
}
