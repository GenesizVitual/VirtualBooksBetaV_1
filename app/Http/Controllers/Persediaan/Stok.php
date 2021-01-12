<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Persediaan\utils\data\Stok as stoks;
use App\Model\Persediaan\Nota as nota;
use App\Model\Persediaan\PembelianBarang;
class Stok extends Controller
{
    public function preview_stok_opname(Request $req){
        try{
            $data_stok= stoks::DaftarStok(['filter_zero'=>1]);
            if(!empty($data_stok)){
                foreach ($data_stok as $data_stok){

                    $data_nota = nota::where('id_instansi',Session::get('id_instansi'))
                        ->findOrFail($data_stok['id_nota']);
                    # Todo Buat Nota
                    $nota_baru = nota::updateOrCreate(
                        [
                            'id_instansi'=>Session::get('id_instansi'),
                            'kode_nota'=>$data_nota->kode_nota,
                            'id_thn_anggaran'=>$req->tahun_anggaran,
                        ],
                        [
                            'tgl_beli'=> $data_nota->tgl_beli,
                            'id_jenis_tbk'=> $data_nota->id_jenis_tbk,
                            'pph'=> $data_nota->pph,
                            'ppn'=> $data_nota->ppn,
                            'id_penyedia'=> $data_nota->id_penyedia,
                        ]
                    );
                    if($nota_baru){
                        $model_pembelian = PembelianBarang::where('id_instansi', Session::get('id_instansi'))->findOrFail($data_stok['id_pembelian']);
                        if(!empty($model_pembelian)){
                            # Todo Import Barang
                           $model_stok_pembelian = PembelianBarang::updateOrCreate(
                               [
                                   'id_instansi'=>$model_pembelian->id_instansi,
                                   'id_nota'=>$nota_baru->id,
                                   'parentID'=>$model_pembelian->id,
                               ],
                               [
                                    'id_penyedia'=>$model_pembelian->id_penyedia,
                                    'id_gudang'=>$model_pembelian->id_gudang,
                                    'jumlah_barang'=>$data_stok['stok_barang'],
                                    'satuan'=>$model_pembelian->satuan,
                                    'harga_barang'=>$model_pembelian->harga_barang,
                                    'tanggal_expired'=>$model_pembelian->tanggal_expired,
                                    'total_beli'=>$model_pembelian->harga_barang*$data_stok['stok_barang'],
                                    'keterangan'=>'Sisa stok barang '.$data_nota->linkToTahunAnggaran->thn_anggaran,
                               ]
                           );
                        }
                    }
                }

            }

            return redirect('stok-opname')->with('message_info','Stok telah selesai ditransfer ke tahun yang dipilih');
        }catch (Throwable $e){
            return false;
        }
    }
}
