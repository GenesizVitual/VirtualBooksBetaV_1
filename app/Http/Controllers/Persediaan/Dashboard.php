<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Instansi;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    //

    public function index()
    {
        $data = [
           'instansi'=>Instansi::where('user_id', Session::get('user_id'))->first()
        ];
        return view('Persediaan.Dashboard.content', $data);
    }

}
