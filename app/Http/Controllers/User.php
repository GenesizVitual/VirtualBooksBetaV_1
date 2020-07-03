<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\AkuntansiDagang\Bisnis;
use Hash;
use Session;

class User extends Controller
{
    //
    public function login(Request $req){
        $user = Users::where('email', $req->email)->first();
        if(Hash::check($req->password, $user->password)){
            $req->session()->put('user_id', $user->id);
            $req->session()->put('nama', $user->name);
            $req->session()->put('level', $user->level);
            if($user->level==0){
                $bisnis = Bisnis::where('user_id', $user->id)->first();
                $req->session()->put('id_bisnis', $bisnis->id);
            }else{
                $req->session()->put('id_bisnis', $user->id_bisnis);
            }
            $req->session()->flash('message_success','Selamat Datang di Aplikasi Manajemen Persediaan');
            return redirect('outlate');
        }else{
            $req->session()->flash('message_fail','email dan password anda salah');
            return redirect('login');
        }
    }

    public function index(){
        $data = Users::all()->where('id_bisnis', Session::get('id_bisnis'));
        return view('AkuntansiDagang.Karyawan.view', array('data'=> $data));
    }

    public function create(){
        return view('AkuntansiDagang.Karyawan.new');
    }

    public function store_karyawan(Request $req){
        $user = new Users();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->level = $req->level;
        $user->id_bisnis = Session::get('id_bisnis');
        if($user->save()){
            $req->session()->flash('message_success','Anda telah berhasil menambahkan karyawan baru');
            return redirect('karyawan');
        }

    }

    public function update_karyawan(Request $req, $id){
        $user = Users::findOrFail($id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->level = $req->level;
        $user->id_bisnis = Session::get('id_bisnis');
        if($user->save()){
            $req->session()->flash('message_success','Anda telah berhasil mengubah data karyawan');
            return redirect('karyawan');
        }
    }

    public function delete_produk(Request $req, $id){
        $user = Users::findOrFail($id);
        if($user->delete()){
            $req->session()->flash('message_success','Anda telah berhasil menghapus data karyawan');
            return redirect('karyawan');
        }
    }


    public function edit($id){
        $data = Users::findOrFail($id);
        return view('AkuntansiDagang.Karyawan.edit', array('data'=> $data));
    }


    public function store(Request $req){
        if($req->password != $req->repeat_password){
            $req->session()->flash('message_fail','Password Anda Tidak Sama');
            return redirect('register');
        }

        $user = new Users();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->level = $req->level;


        if($user->save()){
           $bisnis = new Bisnis();
           $bisnis->nama_bisnis = $req->nama_bisnis;
            $bisnis->jenis_bisnis = "DAGANG";
            $bisnis->alamat = $req->alamat;
            $bisnis->user_id = $user->id;
            if($bisnis->save()){
               $req->session()->flash('message_success','Anda telah berhasil mendaftar');
               return redirect('login');
           }
        }
    }

    public function out(Request $req){
        $req->session()->forget('user_id');
        $req->session()->forget('id_bisnis');
        return redirect('/');
    }
}
