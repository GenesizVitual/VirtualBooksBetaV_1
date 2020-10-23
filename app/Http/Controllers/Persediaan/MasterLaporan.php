<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Model\Persediaan\Berwenang;
use App\Model\Persediaan\Instansi;
use App\Model\Persediaan\JenisTbk;
use App\Http\Controllers\Persediaan\utils\data\Nota;
use App\Http\Controllers\Persediaan\utils\data\PersediaanBarang;
use App\Http\Controllers\Persediaan\utils\data\RekapitulasiPersediaan;
use App\Http\Controllers\Persediaan\utils\SettingReport;
use Illuminate\Http\Request;

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
            'data'=>Nota::data_nota(null),
            'berwenang'=> $this->berwenang(null)
        ];

        return view('Persediaan.laporan.daftar_nota.content', $data);
    }

    # Cetak Data Nota
    public function print_data_daftar_nota(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
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

            # Passing Data
            $data = [
                'data'=>Nota::data_nota(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
            ];
            return view('Persediaan.laporan.daftar_nota.print', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Preview Data Rekapitulasi Persediaan
    public function preview_data_rekapitulasi_persediaan(){
        $data_rekap = RekapitulasiPersediaan::DataRekapitupitulasi(null);
        $jenis_tbk = JenisTbk::all()->where('id_instansi', Session::get('id_instansi'));
        $data = [
            'data'=>$data_rekap,
            'berwenang'=> $this->berwenang(null),
            'jenis_tbk'=> $jenis_tbk
        ];
        return view('Persediaan.laporan.rekapitulasi_persediaan.content', $data);
    }

    # Cetak Data Rekapitulasi Persediaan
    public function print_data_rekapitulasi_persediaan(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
            ]);

            # Panggil Model Jenis TBK
            $jenis_tbk = JenisTbk::all()->where('id_instansi', Session::get('id_instansi'));

            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            RekapitulasiPersediaan::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            RekapitulasiPersediaan::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>RekapitulasiPersediaan::DataRekapitupitulasi(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'jenis_tbk'=> $jenis_tbk
            ];
            return view('Persediaan.laporan.rekapitulasi_persediaan.print', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Preview Data Rekapitulasi Persediaan Perjenis TBK
    public function preview_data_rekapitulasi_persediaan_perjenis_tbk(){
        $data_rekap = RekapitulasiPersediaan::DataRekapitupitulasi(null);
        $jenis_tbk = JenisTbk::all()->where('id_instansi', Session::get('id_instansi'));
        $data = [
            'data'=>$data_rekap,
            'berwenang'=> $this->berwenang(null),
            'jenis_tbk'=> $jenis_tbk
        ];
        return view('Persediaan.laporan.rekapitulasi_persediaan_perjenis_tbk.content', $data);
    }

    # Cetak Data Rekapitulasi Persediaan
    public function print_data_rekapitulasi_persediaan_per_jenis_tbk(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
            ]);

            # Panggil Model Jenis TBK
            $jenis_tbk = JenisTbk::all()->where('id_instansi', Session::get('id_instansi'));

            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            RekapitulasiPersediaan::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            RekapitulasiPersediaan::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>RekapitulasiPersediaan::DataRekapitupitulasi(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'jenis_tbk'=> $jenis_tbk
            ];
            return view('Persediaan.laporan.rekapitulasi_persediaan_perjenis_tbk.print', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Preview Data Persediaan Barang
    public function preview_data_persediaan_barang(){
        try{
            $data_persediaan = PersediaanBarang::PersediaanBarang(null);
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_persediaan
            ];
            return view('Persediaan.laporan.persediaan_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Cetak Data Persediaan Barang
    public function print_data_persediaan_barang(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            PersediaanBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            PersediaanBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>PersediaanBarang::PersediaanBarang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
            ];
            return view('Persediaan.laporan.persediaan_barang.print', $data);
        }catch (Throwable $e){
            return false;
        }
    }




    # list data berwenang
    private function berwenang($id){
        try
        {
            if(empty($id)){
                $model = Berwenang::all()->where('id_instansi', Session::get('id_instansi'));
            }else{
                $model = Berwenang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            }

            return $model;
        }catch (Throwable $e){
            return false;
        }
    }

    # Format ulang tanggal Ke Contoh Format 01 Januari 2020
    private function konversi_bulan($tanggal){
        $remake = explode('-', $tanggal);

        #ambil bulan dari tanggal
        $bulan = $remake['1'];
        if($bulan == '01'){
            $rebuild = "Januari";
        }elseif ($bulan == '02'){
            $rebuild = "Februari";
        }elseif ($bulan == '03'){
            $rebuild = "Maret";
        }elseif ($bulan == '04'){
            $rebuild = "April";
        }elseif ($bulan == '05'){
            $rebuild = "Mei";
        }elseif ($bulan == '06'){
            $rebuild = "Juni";
        }elseif ($bulan == '07'){
            $rebuild = "Juli";
        }elseif ($bulan == '08'){
            $rebuild = "Agustus";
        }elseif ($bulan == '09'){
            $rebuild = "September";
        }elseif ($bulan == '10'){
            $rebuild = "Oktober";
        }elseif ($bulan == '11'){
            $rebuild = "November";
        }elseif ($bulan == '12'){
            $rebuild = "Desember";
        }
        #kombinasikan seluruh tanggal

        return $remake[2].' '.$rebuild.' '.$remake[0];
    }
}
