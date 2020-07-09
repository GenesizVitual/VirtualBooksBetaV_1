<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //

    public function index()
    {
        return view('Apps.Dashboard.content');
    }
}
