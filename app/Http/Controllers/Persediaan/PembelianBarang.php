<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Persediaan\Nota;

class PembelianBarang extends Controller
{
    //


    public function show($id){
        $model = Nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
        dd($model);
        return view('Persediaan.Pembelian.content');
    }

}
