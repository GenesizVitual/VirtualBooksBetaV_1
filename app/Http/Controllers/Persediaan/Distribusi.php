<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Model\Persediaan\Bidang;
use App\Http\Controllers\Persediaan\utils\data\Distribusi as data_form_distribusi;
use App\Http\Controllers\Persediaan\utils\data\Gudang;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\StatusPenerimaan;
use App\Model\Persediaan\Gudang as tbl_gudang;
use App\Model\Persediaan\PembelianBarang as tbl_pembelian;
use App\Model\Persediaan\Distribusi as tbl_distribusi;

class Distribusi extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','distribusi');
            $req->session()->put('sub_menu','');
            return $next($req);
        });
    }

    public function index()
    {
        $data = Gudang::getDataStokBarang(null);

        return view('Persediaan.Distribusi.content', $data);
    }

    public function store(Request $req)
    {

        //kode adalah pk dari pembelian dan
        // pengeluaran pada saat menambah pengeluaran nilai kode_berasal dari pk pembelian dan
        // pada saat mengubah kode berasal dari pk pengeluaran barang


        try{

            $this->validate($req,[
                '_token'=>'required',
                '_method'=>'required',
                'id_bidang'=>'required',
                'jumlah_keluar'=>'required',
                'stok_terakhir'=>'required',
                'tgl_terima'=>'required',
                'tgl_kerluar'=>'required',
                'kode'=>'required',
                //status digunakan untuk membedakan antara penerimaan rutin, kegiatan, dll
                'status'=> 'required',
                'status_pengeluaran'=>'required',
            ]);


            $nreq = $req->except(['_token','_method','status']);
            $pembelian = tbl_pembelian::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            $nreq['id_instansi'] = $pembelian->id_instansi;
            $nreq['id_pembelian'] = $pembelian->id;
            $nreq['id_nota'] = $pembelian->id_nota;
            $nreq['id_penyedia'] = $pembelian->id_penyedia;
            $nreq['id_gudang'] = $pembelian->id_gudang;


            $model_distribusi = new tbl_distribusi($nreq);
            $check_form=$this->validate_($req);

            // mengecek tanggal keluar tidak boleh lebih rendah dari pada tanggal penerimaan
            // dan mengecek jumlah keluar tidak boleh lebih dari jumlah sisa/stok barang penerimaan
            if($check_form['status']==true) {
                return response()->json(['message'=>$check_form['message'],'status_penerimaan'=> $req->status,'kode'=>$model_distribusi->id_pembelian]);
            }else{

                //mencari mengurangi stok yang ada
                $stok = $this->hitung_stok($pembelian->id);

                if($stok <= 0){
                    return response()->json(array('status'=>'error','status_penerimaan'=> $req->status,'message'=>'Stok sudah tidak tersedia'));
                }

                if ($model_distribusi->save())
                {
                    return response()->json(array('status'=> 'success','status_penerimaan'=> $req->status,'stok'=>$stok,'kode'=>$model_distribusi->id_pembelian,'message'=> 'Barang '.$model_distribusi->linkToGudang->nama_barang.', banyak barang '.$model_distribusi->jumlah_keluar));
                }else{
                    return response()->json(array('status'=> 'error','status_penerimaan'=> $req->status,'message'=> 'Barang Gagal dikeluarkan'));
                }
            }

        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function show($id)
    {
        StatusPenerimaan::$id_barang = $id;
        $data =StatusPenerimaan::DataStatusPenerimaan();
        $bidang = Bidang::all()->where('id_instansi', Session::get('id_instansi'));
        $gudang = tbl_gudang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $set_status_penerimaan = data_form_distribusi::$status_keluar;
        return view('Persediaan.Distribusi.tab.content',
            array('data'=>$data,'gudang'=>$gudang,'bidang'=>$bidang,'status_penerimaan'=>$set_status_penerimaan)
        );
    }

    public function edit(Request $req)
    {
        try{
            $this->validate($req,[
                '_token'=>'required',
                '_method'=>'required',
                'kode'=>'required',
            ]);

            $model = tbl_distribusi::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            return response()->json($model);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function update(Request $req, $id){
        try{

            $this->validate($req,[
                '_token'=>'required',
                '_method'=>'required',
                'id_bidang'=>'required',
                'jumlah_keluar'=>'required',
                'stok_terakhir'=>'required',
                'jumlah_keluar'=>'required',
                'tgl_kerluar'=>'required',
                'tgl_terima'=>'required',
                //status digunakan untuk membedakan antara penerimaan rutin, kegiatan, dll
                'status'=> 'required',
                'kode'=>'required',
                'status_pengeluaran'=>'required',
            ]);


            $model_ditribusi = tbl_distribusi::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            $model_ditribusi->id_bidang = $req->id_bidang;
            $model_ditribusi->tgl_kerluar = $req->tgl_kerluar;
            $model_ditribusi->jumlah_keluar = $req->jumlah_keluar;
            $model_ditribusi->status_pengeluaran = $req->status_pengeluaran;
            $model_ditribusi->keterangan = $req->keterangan;

            $check_form=$this->validate_($req);

            // mengecek tanggal keluar tidak boleh lebih rendah dari pada tanggal penerimaan
            // dan mengecek jumlah keluar tidak boleh lebih dari jumlah sisa/stok barang penerimaan
            if($check_form['status']==true) {
                return response()->json(['message'=>$check_form['message'],'status_penerimaan'=> $req->status,'kode'=>$model_ditribusi->id_pembelian]);
            }else{
                //menghitung sisa stok
                $stok = $this->hitung_stok($model_ditribusi->id_pembelian);
                if($stok <= 0){
                    return response()->json(array('status'=>'error','status_penerimaan'=> $req->status,'message'=>'Stok sudah tidak tersedia'));
                }

                if($model_ditribusi->save())
                {
                    return response()->json(array('status'=>'success','stok'=>$stok,'status_penerimaan'=> $req->status,'kode'=>$model_ditribusi->id_pembelian,'message'=>'Anda telah mengubah barang:'.$model_ditribusi->linkToGudang->nama_barang.', Stok:'. $model_ditribusi->jumlah_keluar));
                }else{
                    return response()->json(array('status'=>'error','status_penerimaan'=> $req->status,'message'=>'Gagal, mengubah barang, silahkan cek kembali form'));
                }
            }
        }catch (Throwable $e){
            report($e);
            return false;
        }

    }


    public function destroy(Request $req,$id){
        try{

            $this->validate($req, [
                '_token'=> 'required',
                '_method'=> 'required',
                'status'=> 'required',
                'kode'=> 'required',
            ]);

            $model_ditribusi=tbl_distribusi::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            if($model_ditribusi->delete())
            {
                //menghitung sisa stok
                $stok = $this->hitung_stok($model_ditribusi->id_pembelian);
                return response()->json(array('status'=>'success','status_penerimaan'=> $req->status,'stok'=>$stok,'kode'=>$model_ditribusi->id_pembelian,'message'=>'Anda telah menghapus barang:'.$model_ditribusi->linkToGudang->nama_barang.', Stok:'. $model_ditribusi->jumlah_keluar));
            }else{
                return response()->json(array('status'=>'error','status_penerimaan'=> $req->status,'message'=>'Gagal, menghapus barang, silahkan cek kembali form'));
            }
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }


    public function form_distribusi(Request $request){
        $this->validate($request,[
            '_token'=> 'required',
            '_method'=> 'required',
            'kode'=> 'required' //id_pembelian
        ]);
        $nreq = $request->except(['_token','_method']);
        $data = data_form_distribusi::data_distribusi($nreq);
        $data['id_pembelian']=$request->kode;
        return response()->json($data);
    }


    // Function yang berfungsi sebagai validasi tanggal keluar tidak boleh lebih kecil dari pada tanggal pembelian/penerimaan
    // dan jumlah keluar tidak boleh lebih banyak dari pada kumlah keluar
    private function validate_(Request $req)
    {
        $status = false;
        $array_message = array();
        if($req->jumlah_keluar > $req->stok_terakhir){
            $array = array(
                'status'=>'info',
                'message'=> 'Jumlah keluar tidak boleh melebihi stok akhir'
            );
            $array_message[] = $array;
            $status = true;
        }

        if(date($req->tgl_kerluar) < date($req->tgl_terima)){
            $array = array(
                'status'=>'info',
                'message'=> 'Tanggal keluar harus lebih tinggi dari tanggal beli'
            );
            $array_message[] = $array;
            $status = true;
        }
        return array('status'=>$status, 'message'=> $array_message);
    }

    //function rumus perhitungan stok
    public function hitung_stok($id_pembelian){
        $model_pembelian = tbl_pembelian::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_pembelian);
        $model_pengeluaran = tbl_distribusi::where('id_instansi', Session::get('id_instansi'))->where('id_pembelian', $model_pembelian->id)->sum('jumlah_keluar');
        $stok =  intval($model_pembelian->jumlah_barang)-$model_pengeluaran;
        return $stok;
    }
}
