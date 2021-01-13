<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\User as pengguna;
use App\Model\Persediaan\Instansi;

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
            $req->session()->put('user_id', $model->id);
            $req->session()->put('kode', $model->id);
            $req->session()->put('level', $model->level);
            $req->session()->put('name', $model->name);
            # Pengisian Instansi diawal aplikasi dimulai
            if($model->status_syarat == 0)
            {
                return redirect('pengaturan-awal')->with('message_info','Lengkapilah formulir pengaturan awal...!');
            }
            # Set session id Instansi
            if(!empty($model->linkToInstansi->id)){
                $req->session()->put('id_instansi', $model->linkToInstansi->id);
            }

            $model_instansi = Instansi::find(Session::get('id_instansi'));
            $cek_thn_anggaran = $model_instansi->LinkToTahunAnggaran->where('status','1')->first();
            if(empty($cek_thn_anggaran)){
                return redirect('penentuan-tahun-anggaran')->with('message_info','Silahkah, masukan tahun anggaran');
            }

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
        $model->level = '1';
        if($model->save())
        {
            if (empty($req->session()->user_id)){
                return redirect('login')->with('message_success','Silahkan login 5 menit kemudian');
            }else{
                return "User telah ditambahkan";
            }
        }
    }

    public function check_email($req){
        $model = pengguna::where('email',$req->email)->where('level',1)->first();
        if(empty($model)){
            return false;
        }else{
            return true;
        }
    }

    public function LogOut(Request $req){
        $req->session()->flush();
        return redirect('login')->with('message_success','Anda telah keluar dari aplikasi');
    }
}
