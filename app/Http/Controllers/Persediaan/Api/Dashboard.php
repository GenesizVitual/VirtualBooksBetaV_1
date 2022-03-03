<?php

namespace App\Http\Controllers\Persediaan\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Instansi;
use App\Http\Controllers\Persediaan\utils\data\Dashboard as data_dashboard;
use Session;

class Dashboard extends Controller
{
    //

    public function dataDashboard(Request $req)
    {
        $data = [
            'instansi' => Instansi::where('user_id', Session::get('user_id'))->first(),
            'data_rekap' => data_dashboard::JumlahjenisTBK(null)['data_rekap'],
            'data_jenis_rekap' => data_dashboard::data_rekap_persediaan(),
            'jumlah_perimaan' => data_dashboard::JumlahjenisTBK(null)['total_rekap'],
            'jumlah_keluar' => data_dashboard::sumTotalPengeluaran(null)['total_pengeluaran'],
            'stok_opname' => data_dashboard::sisa_stok(),
            'sisa_uang_pembelian' => data_dashboard::JumlahjenisTBK(null)['total_rekap'] - data_dashboard::sumTotalPengeluaran(null)['total_pengeluaran']
        ];
        //        dd($data['data_jenis_rekap']);
        return response()->json($data);
    }
}
