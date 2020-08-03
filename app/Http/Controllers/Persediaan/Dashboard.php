<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //

    public function index()
    {
        return view('Persediaan.Dashboard.content');
    }
}
