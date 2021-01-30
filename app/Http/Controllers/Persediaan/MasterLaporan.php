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
use App\Http\Controllers\Persediaan\utils\StatusPenerimaan;
use App\Http\Controllers\Persediaan\utils\data\PengeluaranBarang;
use App\Http\Controllers\Persediaan\utils\data\MutasiBarang;
use App\Http\Controllers\Persediaan\utils\data\Stok;
use App\Model\Persediaan\Gudang;
use Illuminate\Http\Request;
use App\Model\Persediaan\TahunAnggaran;
use App\Exports\viewExport;
use Excel;
use Session;

class MasterLaporan extends Controller
{
    //



    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','laporan');
            $req->session()->put('sub_menu','');
            return $next($req);
        });
    }

    public function index(){
       $setting = SettingReport::$report;
       return view('Persediaan.laporan.master_laporan.content',['setting_laporan'=>$setting]);
    }

    # Todo:Preview Data Nota
    public function preview_data_daftar_nota(){
        Nota::$status = true;
        $data = [
            'data'=>Nota::data_nota(null),
            'berwenang'=> $this->berwenang(null)
        ];

        return view('Persediaan.laporan.daftar_nota.content', $data);
    }

    # Todo:Cetak Data Nota
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
            if($req->button=='cetak'){
                return view('Persediaan.laporan.daftar_nota.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.daftar_nota.export_excel', $data),'Daftar nota.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview Data Rekapitulasi Persediaan
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

    # Todo:Cetak Data Rekapitulasi Persediaan
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
            if($req->button=='cetak'){
                return view('Persediaan.laporan.rekapitulasi_persediaan.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.rekapitulasi_persediaan.export_excel', $data),'rekapitulasi persediaan.xlsx');
            }
            else{

            }

        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview Data Rekapitulasi Persediaan Perjenis TBK
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

    # Todo:Cetak Data Rekapitulasi Persediaan Perjenis TBK
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
            if($req->button=='cetak'){
                return view('Persediaan.laporan.rekapitulasi_persediaan_perjenis_tbk.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.rekapitulasi_persediaan_perjenis_tbk.export_excel', $data),'rekapitulasi persediaan per jenis tbk.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview Data Persediaan Barang
    public function preview_data_persediaan_barang(){
        try{
            $data_persediaan = PersediaanBarang::PersediaanBarang(null);
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_persediaan,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.persediaan_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Data Persediaan Barang
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
                'status_penerimaan'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            PersediaanBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            PersediaanBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            PersediaanBarang::$status_penerimaan = $req->status_penerimaan;

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
                'status_penerimaan'=> $req->status_penerimaan
            ];
            if($req->button=='cetak'){
                return view('Persediaan.laporan.persediaan_barang.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.persediaan_barang.export_excel', $data),'data persediaan.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview Data Pengeluaran Barang
    public function preview_data_pengeluaran_barang(){
        try{
            $data_pengeluaran = PengeluaranBarang::pengeluaran_barang(null);

            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.pengeluaran_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Data Persediaan Barang
    public function print_data_pengeluaran_barang(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            PengeluaranBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            PengeluaranBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            PengeluaranBarang::$status_penerimaan = $req->status_penerimaan;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>PengeluaranBarang::pengeluaran_barang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];
            if($req->button=='cetak'){
                return view('Persediaan.laporan.pengeluaran_barang.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.pengeluaran_barang.export_excel', $data),'Data pengeluaran barang.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview barang pakai habis
    # Data barang pakai habis berasal dari utils data pengeluaran barang karena format data yang disesuaikan dengan barang pakai habis,
    public function preview_data_barang_barang_pakai_habis(){
        try{
            $data_pengeluaran = PengeluaranBarang::pengeluaran_barang(null);
//            dd($data_pengeluaran);
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.barang_pakai_habis.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak barang pakai habis
    # Data barang pakai habis berasal dari utils data pengeluaran barang karena format data yang disesuaikan dengan barang pakai habis
    public function print_data_barang_pakai_habis(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            PengeluaranBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            PengeluaranBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            PengeluaranBarang::$status_penerimaan = $req->status_penerimaan;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>PengeluaranBarang::pengeluaran_barang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];

            if($req->button=='cetak'){
                return view('Persediaan.laporan.barang_pakai_habis.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.barang_pakai_habis.export_excel', $data),'Data Barang Pakai Habis.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview semester
    # Data barang pakai habis berasal dari utils data pengeluaran barang karena format data yang disesuaikan dengan semester,
    public function preview_data_semester(){
        try{
            $data_pengeluaran = PengeluaranBarang::pengeluaran_barang(null);
//            dd($data_pengeluaran);
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.semester.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak barang pakai habis
    # Data barang pakai habis berasal dari utils data pengeluaran barang karena format data yang disesuaikan dengan barang pakai habis
    public function print_data_barang_semester(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required',
                'semester'=> 'required',
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            PengeluaranBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            PengeluaranBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            PengeluaranBarang::$status_penerimaan = $req->status_penerimaan;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>PengeluaranBarang::pengeluaran_barang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan,
                'semester'=> $req->semester,
                'tahun' =>PengeluaranBarang::$tahun
            ];

            if($req->button=='cetak'){
                return view('Persediaan.laporan.semester.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.semester.export_excel', $data),'Data Barang Semester.xlsx');
            }
            else{

            }


        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview kartu barang
    # Data kartu barang berasal dari class util data,
    public function preview_kartu_barang(){

        try{
            $data_pengeluaran = MutasiBarang::mutasi_barang(null);
            $data_gudang  = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'data_barang'=> $data_gudang,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.kartu_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Kartu Barang
    # Data kartu barang berasal dari class util data,
    public function print_kartu_barang(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required',
                'id_gudang'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            MutasiBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            MutasiBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            MutasiBarang::$status_penerimaan = $req->status_penerimaan;
            MutasiBarang::$id_barang = $req->id_gudang;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>MutasiBarang::mutasi_barang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];
            if($req->button=='cetak'){
                return view('Persediaan.laporan.kartu_barang.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.kartu_barang.export_excel', $data),'Data Kartu Barang.xlsx');
            }
            else{

            }

        }catch (Throwable $e){
            return false;
        }
    }


    # Todo:Preview mutasi barang
    # Data mutasi barang berasal dari class util data,
    public function preview_mutasi_barang(){

        try{
            $data_pengeluaran = MutasiBarang::mutasi_barang(null);
            $data_gudang  = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'data_barang'=> $data_gudang,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.mutasi_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Kartu Barang
    # Data kartu barang berasal dari class util data,
    public function cetak_mutasi_barang(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required',
                'id_gudang'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            MutasiBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            MutasiBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            MutasiBarang::$status_penerimaan = $req->status_penerimaan;
            MutasiBarang::$id_barang = $req->id_gudang;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>MutasiBarang::mutasi_barang(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];

            if($req->button=='cetak'){
                return view('Persediaan.laporan.mutasi_barang.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.mutasi_barang.export_excel', $data),'Data mutasi.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview mutasi barang
    # Data mutasi barang berasal dari class util data,
    public function preview_stok_barang(){
        try{
            $data_pengeluaran = Stok::DaftarStok(null);
            $data_gudang  = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'data_barang'=> $data_gudang,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan()
            ];
            return view('Persediaan.laporan.stok_barang.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Stok barang
    # Data mutasi barang berasal dari class util data,
    public function cetak_stok_barang(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required',
                'id_gudang'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            Stok::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            Stok::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            Stok::$status_penerimaan = $req->status_penerimaan;
            Stok::$id_barang = $req->id_gudang;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>Stok::DaftarStok(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];
            if($req->button=='cetak'){
                return view('Persediaan.laporan.stok_barang.print', $data);
            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.stok_barang.export_excel', $data),'Data Stok Barang.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Preview stock opname
    # Data mutasi barang berasal dari class util data,
    public function preview_stok_opname(){
        try{
            $data_pengeluaran = Stok::DaftarStok(null);
            $data_gudang  = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
            $data = [
                'berwenang'=>$this->berwenang(null),
                'data'=>$data_pengeluaran,
                'data_barang'=> $data_gudang,
                'jenis_penerimaan'=>StatusPenerimaan::SetStatusPenerimaan(),
                'thn_anggaran_aktif'=> TahunAnggaran::where('id_instansi', Session::get('id_instansi'))->where('status','1')->first(),
                'tahun_anggaran'=> TahunAnggaran::all()->where('id_instansi', Session::get('id_instansi'))->sortBy('thn_anggaran')
            ];
            return view('Persediaan.laporan.stok_opname.content', $data);
        }catch (Throwable $e){
            return false;
        }
    }

    # Todo:Cetak Stok opname
    # Data stok opname berasal dari class util data,
    public function cetak_stok_opname(Request $req){

        try{
            $this->validate($req,[
                'tgl_awal'=> 'required',
                'tgl_akhir'=> 'required',
                'tgl_cetak'=> 'required',
                'berwenang_1'=> 'required',
                'berwenang_2'=> 'required',
                'jabatan1'=> 'required',
                'jabatan2'=> 'required',
                'status_penerimaan'=> 'required',
                'id_gudang'=> 'required'
            ]);


            # Kondisi tanggal awal tidak boleh melebihi tanggal akhir
            if (date('d-m-Y', strtotime($req->tgl_awal)) >= date('d-m-Y', strtotime($req->tgl_akhir))){
                return redirect()->back()->with('message_info','Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }

            # Inisialisasi Variable di clas Rekapitulasi Persediaan
            Stok::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            Stok::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
            Stok::$status_penerimaan = $req->status_penerimaan;
            Stok::$id_barang = $req->id_gudang;

            # Data Instansi
            $data_instansi = Instansi::findOrFail(Session::get('id_instansi'));

            # Passing Data
            $data = [
                'data'=>Stok::DaftarStok(null),
                'instansi' => $data_instansi,
                'tgl_cetak' => $this->konversi_bulan($req->tgl_cetak),
                'berwenang_1' => $this->berwenang($req->berwenang_1),
                'berwenang_2' => $this->berwenang($req->berwenang_2),
                'jabatan_1'=> $req->jabatan1,
                'jabatan_2'=> $req->jabatan2,
                'status_penerimaan'=> $req->status_penerimaan
            ];
            if($req->button=='cetak'){
                return view('Persediaan.laporan.stok_opname.print', $data);

            }else if($req->button=='excel'){
                return Excel::download(new viewExport('Persediaan.laporan.stok_opname.export_excel', $data),'Data Stok Opname.xlsx');
            }
            else{

            }
        }catch (Throwable $e){
            return false;
        }

    }


    # Todo:list data berwenang
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

    # Todo:Format ulang tanggal Ke Contoh Format 01 Januari 2020
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
