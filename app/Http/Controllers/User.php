<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\User as pengguna;

use Hash;


class User extends Controller
{
    //

    public function login(){
        return view('page_login_regis.login');
    }

    public function Usercheck(Request $req)
    {
        $model = pengguna::where('email', $req->email)->first();
        if(Hash::check($req->pass, $model->password)){
            $req->session()->put('name', $model->name);
            $req->session()->put('user_id', $model->id);
            return redirect('dashboard')->with('message_success','Selamat Datang '.$model->name);
        }else{
            return redirect('login')->with('message_error','Maaf, Email atau password anda salah. silahkah coba lagi');
        }
    }

    public function register(){
        return view('page_login_regis.register');
    }

    public function store(Request $req)
    {

        if($this->check_email($req)==true){
            return redirect('register')->with('message_error','Email anda telah terdaftar');
        }

        $model = new pengguna();
        $model->name = $req->name;
        $model->email = $req->email;
        $model->password = bcrypt($req->pass);
        if($model->save())
        {
            if (empty($req->session()->user_id)){
                return redirect('register')->with('message_success','Silahkan login 5 menit kemudian');
            }else{
                return "User telah ditambahkan";
            }
        }
    }

    public function check_email($req){
        $model = pengguna::where('email',$req->email)->where('level',0)->first();
        if(empty($model)){
            return false;
        }else{
            return true;
        }
    }
}
