<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\SuratPermintaan;
use App\Http\Controllers\Persediaan\utils\data\Distribusi;
use App\Model\Persediaan\Berwenang;
use App\Model\Persediaan\Instansi;
use App\Model\Persediaan\SuratPengeluaran as tbl_surat_pengeluaran;
use Session;
class SuratPengeluaran extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','surat');
            $req->session()->put('sub_menu','surat_pengeluaran');
            return $next($req);
        });
    }

    public function index(){
       $data = SuratPermintaan::all()->where('id_instansi', Session::get('id_instansi'))->groupBy('id_bidang');
       return view('Persediaan.Surat.SuratPengeluaran.content', ['bidang'=>$data]);
    }

    public function show($id_bidang){
        try{
            $data = SuratPermintaan::all()->where('id_instansi', Session::get('id_instansi'))->where('id_bidang',$id_bidang);
            return view('Persediaan.Surat.SuratPengeluaran.content', ['id_bidang'=>$id_bidang, 'data'=>$data]);
        }catch (Throwable $e){
            return false;
        }
    }

    public function created_surat($id_surat_permintaan){
        try{
            $model_surat_pemintaan = SuratPermintaan::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_surat_permintaan);
            $array =['tgl_keluar'=>$model_surat_pemintaan->tgl_permintaan_barang,'id_bidang'=> $model_surat_pemintaan->id_bidang];
            $data_array = Distribusi::data_pengeluaran_by_id_dan_tanggal($array);
            $data_array['berwenang'] = Berwenang::all()->where('id_instansi',Session::get('id_instansi'));
            $data_array['instansi'] = Instansi::findOrFail(Session::get('id_instansi'));
            $data_array['tgl_permintaan_barang'] = $model_surat_pemintaan->tgl_permintaan_barang;
            $data_array['id_surat_permintaan_barang'] = $id_surat_permintaan;
            $data_array['data_surat']= tbl_surat_pengeluaran::where('id_instansi', Session::get('id_instansi'))->where('id_surat_permintaan', $model_surat_pemintaan->id)->first();
            return view('Persediaan.Surat.SuratPengeluaran.template_surat', $data_array);
        }catch (Throwable $e){
            return false;
        }
    }

    public function store(Request $req){
        try{

            $this->validate($req,[
                'nomor_surat'=> 'required|unique:tbl_surat_pengeluaran,nomor_surat',
                'perihal'=> 'required',
                'id_bidang'=> 'required',
                'id_berwenang'=> 'required',
                'isi_surat'=> 'required',
                'id_barang'=> 'required',
                'penutup_surat'=> 'required',
                'tgl_surat'=> 'required',
                'title_penyedia'=> 'required',
                'id_berwenang1'=> 'required',
                'title_jabatan'=> 'required',
                'id_berwenang2'=> 'required',
            ]);

            $model = tbl_surat_pengeluaran::updateOrCreate(
                ['id_bidang'=>$req->id_bidang,'id_surat_permintaan'=>$req->id_surat_permintaan_barang,'id_instansi'=>Session::get('id_instansi'),'nomor_surat'=>$req->nomor_surat],
                [
                    'isi_surat'=>$req->isi_surat,
                    'id_barang'=>$req->id_barang,
                    'penutup_surat'=>$req->penutup_surat,
                    'tgl_permintaan_barang'=>$req->tgl_permintaan_barang,
                    'tgl_surat'=>$req->tgl_surat,
                    'title_penyedia'=>$req->title_penyedia,
                    'title_jabatan'=>$req->title_jabatan,
                    'id_berwenang'=>$req->id_berwenang,
                    'id_berwenang1'=>$req->id_berwenang1,
                    'id_berwenang2'=>$req->id_berwenang2,
                ]
            );

            if($model){
                return redirect()->back()->with('message_info','Surat Permintaan dengan no:'.$model->nomor_surat.' telah dibuat');
            }else{
                return redirect()->back()->with('message_error','No surat permintaan:'.$model->nomor_surat.' gagal dibuat');
            }

        }catch (Throwable $e){
            return false;
        }
    }
}
