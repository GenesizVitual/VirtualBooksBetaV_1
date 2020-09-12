<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Nota;
use App\Model\Persediaan\TahunAnggaran;

use Session;
class TBK extends Controller
{
    //

    public function index()
    {
        return view('Persediaan.TBK.content');
    }
}
