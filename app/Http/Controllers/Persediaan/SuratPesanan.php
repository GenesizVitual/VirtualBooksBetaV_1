<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\data\Nota;
use App\Model\Persediaan\Berwenang;
use App\Model\Persediaan\SuratPesanan as tbl_surat_pesanan;

class SuratPesanan extends Controller
{
    //
    public function index(){

    }

    public function show($id_nota){
        try{
            Nota::$id_nota = $id_nota;
            $data_nota = Nota::data_pembelian_barang_per_nota();
//            dd($data_nota);
            $data_nota['berwenang'] = Berwenang::all()->where('id_instansi', Session::get('id_instansi'));
            return view('Persediaan.Surat.SuratPesanan.content', $data_nota);
        }catch (Throwable $e){
            return $e;
        }
    }

    public function store(Request $req)
    {
        try{
            $this->validate($req,[
                'id_nota'=> 'required',
                'nomor_surat'=> 'required|unique:tbl_surat_pesanan,nomor_surat',
                'id_berwenang'=> 'required',
                'alamat'=> 'required',
                'jabatan'=> 'required',
                'tanggal_terima'=> 'required',
                'tanggal_penyelesaian'=> 'required',
                'title_penyedia'=> 'required',
                'title_jabatan'=> 'required',
            ]);

            $model = tbl_surat_pesanan::updateOrCreate(
                ['id_nota'=> $req->id_nota,'id_instansi'=>Session::get('id_instansi')],
                ['nomor_surat'=>$req->nomor_surat,'id_berwenang'=>$req->id_berwenang,'alamat'=>$req->alamat,
                    'jabatan'=>$req->jabatan,'tanggal_terima'=> $req->tanggal_terima,
                    'syarat'=> $req->syarat,
                    'tanggal_penyelesaian'=> $req->tanggal_penyelesaian,
                    'judul_penyedia'=>$req->title_penyedia,
                    'judul_jabatan'=> $req->title_jabatan,
                ]
            );

            if($model){
                return redirect()->back()->with('message_success','Surat telah disimpan dengan nomor :'. $model->nomor_surat);
            }else{
                return redirect()->back()->with('message_error','Surat No:'. $model->nomor_surat.' gagal disimpan');
            }

        }catch (Throwable $e){
            return false;
        }
    }
}
