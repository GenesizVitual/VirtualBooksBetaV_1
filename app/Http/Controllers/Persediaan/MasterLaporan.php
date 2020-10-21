<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\SettingReport;
use App\Http\Controllers\Persediaan\utils\data\Nota;
use App\Model\Persediaan\Instansi;
use Session;

class MasterLaporan extends Controller
{
    //
    public function index(){
       $setting = SettingReport::$report;
       return view('Persediaan.laporan.master_laporan.content',['setting_laporan'=>$setting]);
    }

    # Preview Data Nota
    public function preview_data_daftar_nota(){
        Nota::$status = true;
        $data = [
            'data'=>Nota::data_nota(null)
        ];
        return view('Persediaan.laporan.daftar_nota.content', $data);
    }

    # Cetak Data Nota
    public function print_data_daftar_nota(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
            ]);

            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Nota
            Nota::$status = true;
            Nota::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            Nota::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Pass Datang
            $data = [
                'data'=>Nota::data_nota(null),
                'instansi' => $data_instansi
            ];
            return view('Persediaan.laporan.daftar_nota.print', $data);
        }catch (Throwable $e){
            return false;
        }
    }
}
