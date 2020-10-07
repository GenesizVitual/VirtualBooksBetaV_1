<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\data\Distribusi;
use App\Model\Persediaan\Berwenang;
use Session;
use App\Model\Persediaan\Instansi;

class SuratPermintaan extends Controller
{
    //
    public function index(){
        #Tampilkan bidang yang telah difilter pada table ditribusi barang
        try{
            $model = Distribusi::data_pengeluaran_bidang(null);
            return view('Persediaan.Surat.SuratPermintaan.content',['bidang'=> $model['bidang']]);
        }catch (Throwable $e){
            return false;
        }
    }

    public function show($id){
        try{
            $array = ['id_bidang'=> $id];
            $model = Distribusi::data_pengeluaran_bidang($array);
            return view('Persediaan.Surat.SuratPermintaan.content',['bidang'=> $model['bidang'], 'tgl_permintaan'=> $model['tgl_pp'],'id_bidang'=>$model['id_bidang']]);
        }catch (Throwable $e){
            return false;
        }
    }

    public function created_surat($id_bidang, $tgl){
        try{
            $array =['tgl_keluar'=>$tgl,'id_bidang'=> $id_bidang];
            $data_array = Distribusi::data_pengeluaran_by_id_dan_tanggal($array);
            $data_array['berwenang'] = Berwenang::all()->where('id_instansi',Session::get('id_instansi'));
            $data_array['instansi'] = Instansi::findOrFail(Session::get('id_instansi'));
            return view('Persediaan.Surat.SuratPermintaan.template_surat', $data_array);
        }catch (Throwable $e){
            return false;
        }
    }

    public function store(Request $req){
        try{
            $this->validate($req,[
                'nomor_surat'=> 'required',
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


        }catch (Throwable $e){

        }
    }
}
