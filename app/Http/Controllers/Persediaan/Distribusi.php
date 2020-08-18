<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\data\Gudang;
use App\Http\Controllers\Persediaan\utils\StatusPenerimaan;
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
        StatusPenerimaan::$id_barang = $id;
        $data =StatusPenerimaan::DataStatusPenerimaan();
        return view('Persediaan.Distribusi.tab.content', array('data'=>$data,'id_barang'=>$id));
    }


}
