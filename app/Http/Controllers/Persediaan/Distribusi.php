<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\data\Gudang;
use App\Http\Controllers\Persediaan\utils\data\PembelianBarang;
class Distribusi extends Controller
{
    //

    public function index()
    {
        $data = Gudang::getDataStokBarang(null);
        return view('Persediaan.Distribusi.content', $data);
    }

    public function show($id)
    {
        $array = [
            'status_pembayaran'=> '0'
        ];
        $data = PembelianBarang::data_pembelian($array);
        dd($data);
    }

}
