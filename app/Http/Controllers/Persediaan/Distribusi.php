<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\data\Gudang;
use App\Http\Controllers\Persediaan\utils\StatusPenerimaan;
use App\Model\Persediaan\Bidang;
use Session;
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
        $bidang = Bidang::all()->where('id_instansi', Session::get('id_instansi'));
        return view('Persediaan.Distribusi.tab.content', array('data'=>$data,'id_barang'=>$id,'bidang'=>$bidang));
    }


}
