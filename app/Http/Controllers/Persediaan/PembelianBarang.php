<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Persediaan\Nota;
use App\Model\Persediaan\Gudang;
use App\Model\Persediaan\PembelianBarang as pembelian;
use App\Http\Controllers\Persediaan\utils\data\Nota as data_nota;
use App\Http\Controllers\Persediaan\utils\data\PembelianBarang as data_pembelian;


class PembelianBarang extends Controller
{
    //

    public function show($id){
        $model = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        $gudang = Gudang::all()->where('id_instansi', Session::get('id_instansi'));
        return view('Persediaan.Pembelian.content', array('nota'=> $model,'gudang'=> $gudang));
    }

    public function store_barang(Request $req, $id_nota){

        $this->validate($req,[
            '_token'=>'required',
            'id_gudang'=> 'required',
            'jumlah_barang'=> 'required',
            'harga_barang'=> 'required',
        ]);

        $notas = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_nota);

        $n_req = $req->except(['_token','_method']);
        $n_req['id_instansi'] = $notas->id_instansi;
        $n_req['id_nota'] = $notas->id;
        $n_req['id_penyedia'] = $notas->id_penyedia;

        $data_pajak = $this->cek_pajak(($req->jumlah_barang*$req->harga_barang), $notas->id) ;
        $n_req['total_beli'] =$data_pajak->total;
        $n_req['total_ppn'] =$data_pajak->total_ppn;
        $n_req['total_pph'] =$data_pajak->total_pph;

        $model = new pembelian($n_req);

        if($model->save()){
            return response()->json(array('status'=>'success','message'=>'Anda telah menambahkan data pembelian dengan nama barang :'.$model->linkToGudang->nama_barang));
        }else{
            return response()->json(array('status'=>'error','message'=>'Gagal, menambahkan data pembelian barang'));
        }
    }


    public function edit($id){
        try{
            $model = pembelian::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            $data = [
                'data'=> $model
            ];
            return response()->json($data);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function update(Request $req, $id_barang_pembelian){
        $this->validate($req,[
            '_token'=>'required',
            'id_gudang'=> 'required',
            'jumlah_barang'=> 'required',
            'harga_barang'=> 'required',
        ]);

        try
        {
            $model = pembelian::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_barang_pembelian);
            $model->id_gudang = $req->id_gudang;
            $model->jumlah_barang = $req->jumlah_barang;
            $model->satuan = $req->satuan;
            $model->harga_barang = $req->harga_barang;
            $model->tanggal_expired = $req->tanggal_expired;

            $total_beli = $req->jumlah_barang * $req->harga_barang;
            $data_pajak = $this->cek_pajak($total_beli, $model->id_nota);

            $model->total_beli = $data_pajak->total;
            $model->total_ppn  = $data_pajak->total_ppn;
            $model->total_pph  = $data_pajak->total_pph;
            $model->keterangan = $req->keterangan;

            if($model->save()){
                return response()->json(array('status'=>'success','message'=>'Anda telah mengubah data pembelian dengan nama barang :'.$model->linkToGudang->nama_barang));
            }else{
                return response()->json(array('status'=>'error','message'=>'Gagal, mengubah data pembelian barang'));
            }
        }catch (Throwable $e){
            report($e);
            return false;
        }


    }

    public function destroy(Request $req, $id){
        $this->validate($req,[
            '_method'=>'required',
            '_token'=> 'required'
        ]);

        try
        {
            $model = pembelian::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            if($model->delete()){
                return response()->json(array('status'=>'success','message'=>'Anda telah menghapus data pembelian dengan nama barang :'.$model->linkToGudang->nama_barang));
            }else{
                return response()->json(array('status'=>'error','message'=>'Gagal, menghapus data pembelian barang'));
            }
        }
        catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function data_pembelian_barang_pernota(Request $req, $id_nota)
    {
        $this->validate($req,[
            '_token'=> 'required'
        ]);
        data_nota::$id_nota = $id_nota;
        $data = data_nota::data_pembelian_barang_per_nota();
        return response()->json($data);
    }

    public function data_pembelian_barang_perbarang(Request $req)
    {
        $this->validate($req,[
            'kode_barang'=> 'required',
            'status_pembayaran'=> 'required',
            '_method'=> 'required',
            'metode'=> 'required',
            '_token'=> 'required'
        ]);

        $array = [
            'status_pembayaran'=> $req->status_pembayaran,
            'id_barang'=> $req->kode_barang,
            'metode'=> $req->metode,
        ];
       $ndata = data_pembelian::data_pembelian($array);
        return response()->json($ndata);
    }

    private function cek_pajak($total, $id_nota){

        $model_notal = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_nota);

        $total_ppn=0;
        $total_pph=0;

        if($model_notal->ppn==1){
            $total_ppn = $total*0.1;
        }

        if($model_notal->ppn==1){
            $total_pph = $total*0.015;
        }

        $data_pajak = new \stdClass();
        $data_pajak->total = $total;
        $data_pajak->total_ppn = $total_ppn;
        $data_pajak->total_pph = $total_pph;

        return $data_pajak;
    }

}
