<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboad extends Controller
{
    //
    public function index(){
        return view('Admin.base');
    }
}
