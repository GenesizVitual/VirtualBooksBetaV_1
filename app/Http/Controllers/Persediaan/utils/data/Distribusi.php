<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 21/08/2020
 * Time: 14:20
 */

namespace app\Http\Controllers\Persediaan\utils\data;
//use App\Model\Persediaan\Bidang;
use App\Http\Controllers\Persediaan\utils\RenderParsial;
use Session;
use App\Model\Persediaan\PembelianBarang;
//use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Persediaan\utils\TahunAggaranCheck;
use App\Model\Persediaan\Distribusi as tbl_distribusi;
use App\Model\Persediaan\SuratPermintaan;
class Distribusi
{

    public static $status_keluar = [
      'Non Expired',
      'Expired',
    ];

    public static function data_distribusi($array){
        try{
            $id_pembelian = $array['kode'];
            $model_pembelian = PembelianBarang::where('id_instansi', Session::get('id_instansi'))->findOrFail($id_pembelian);
            $no = 1;
            $row = array();
            foreach ($model_pembelian->linkToDistribusi as $data_distribusi)
            {
                $column = array();
                $column[] = $no++;
                $column[] = $data_distribusi->linkToBidang->nama_bidang;
                $column[] = date('d-m-Y', strtotime($data_distribusi->tgl_kerluar));
                $column[] = $data_distribusi->jumlah_keluar;
                $column[] = self::$status_keluar[$data_distribusi->status_pengeluaran];
                $column[] = $data_distribusi->keterangan;
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.button_distribusi', $data_distribusi);
                $row[] = $column;
            }
            return array('data_form'=> $row,'tgl_beli'=>$model_pembelian->linkToNota->tgl_beli);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }


    # cek data bidang dari distribusi barang sebagai filter bidang
    public static function data_pengeluaran_bidang($array)
    {
        try{
            $tahun_anggaran = TahunAggaranCheck::tahun_anggaran_aktif(['id_instansi'=> Session::get('id_instansi')]);
            $model_tahun_anggaran = TahunAggaranCheck::$id_thn_anggaran;

            # Filter semua pengeluaran barang menggunakan tgl_pengeluaran berdasarkan tahun anggaran
            $model_distribusi = tbl_distribusi::whereYear('tgl_kerluar', $model_tahun_anggaran->thn_anggaran)->where('id_instansi', Session::get('id_instansi'))
                ->groupBy('id_bidang')->get();
            $data_tgl_permintaan = [];
            $id_bidang = 0;
            if(!empty($array['id_bidang'])){

                $model_distribusi = tbl_distribusi::where('id_bidang', $array['id_bidang'])->whereYear('tgl_kerluar', $model_tahun_anggaran->thn_anggaran)->where('id_instansi', Session::get('id_instansi'))
                    ->groupBy('id_bidang')->get();
                $id_bidang = $array['id_bidang'];
                $model = tbl_distribusi::where('id_bidang', $array['id_bidang'])->where('id_instansi', Session::get('id_instansi'))->orderBy('tgl_kerluar','desc')->groupBy('tgl_kerluar')->get();
                foreach ($model as $item) {
                    $column = [];
                    $column['id_bidang']= $item->id_bidang;
                    $column['tgl_keluar']= $item->tgl_kerluar;
                    $no_surat='';
                    $model_surat_permintaan = SuratPermintaan::where('id_instansi', Session::get('id_instansi'))->whereDate('tgl_permintaan_barang',$item->tgl_kerluar)->where('id_bidang',$id_bidang)->first();
                    if(!empty($model_surat_permintaan)){
                        $no_surat = $model_surat_permintaan->nomor_surat;
                    }
                    $column['nomor_surat']= $no_surat;
                    $data_tgl_permintaan[] = $column;
                }
            }
            return ['bidang'=>$model_distribusi,'tgl_pp'=> $data_tgl_permintaan,'id_bidang'=> $id_bidang];
        }catch (Throwable $e){
            return false;
        }
    }

    # menampilkan data barang sesuai bidang dan tanggal yang dikirim
    public static function data_pengeluaran_by_id_dan_tanggal($array){
        try
        {
            if(!empty($array)){
                $model_pengeluaran = tbl_distribusi::whereDate('tgl_kerluar',$array['tgl_keluar'])->where('id_bidang', $array['id_bidang'])
                ->where('id_instansi', Session::get('id_instansi'))->orderBy('created_at');
                $row =array();
                foreach ($model_pengeluaran->get() as $data)
                {
                    $column = array();
                    $column['id'] = $data->id;
                    $column['nama_barang'] = $data->linkToGudang->nama_barang;
                    $column['satuan'] = $data->linkToPembelian->satuan;
                    $column['jumlah_barang'] = $data->jumlah_keluar;
                    $row[] = $column;
                }
                return ['data_barang'=> $row, 'bidang'=>$model_pengeluaran->first()->linkToBidang];
            }
        }catch (Throwable $e){
            return false;
        }
    }

}