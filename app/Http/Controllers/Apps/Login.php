<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as pengguna;
use Hash;

class Login extends Controller
{
    //
    public function cek_authority(Request $req){
        $model = pengguna::where('email', $req->email)->where('level','0')->first();
        if(empty($model)){
            return redirect('admin')->with('message_info', 'email tidak ditemukan');
        }

        if(Hash::check($req->pasword, $model->password)){
            $req->session()->put('name', $model->name);
            $req->session()->put('id_admin', $model->id);

            return redirect('admin-dashboard')->with('message_success','Selamat Datang '.$model->name);
        }else{
            return redirect('admin')->with('message_info', 'email tidak ditemukan');
        }

        return "";
    }
}
