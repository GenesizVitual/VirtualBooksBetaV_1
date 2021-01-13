<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use App\Model\Persediaan\Instansi as instance;
use App\Model\Apps\KotaProv;
use Illuminate\Http\Request;
use App\Model\Apps\Provinsi;
use App\User;
use Session;
class Instansi extends Controller
{

    public function __construct()
    {
        $this->middleware(function($req, $next){
            $req->session()->put('menu','data_master');
            $req->session()->put('sub_menu','instansi');
            return $next($req);
        });
    }

    public function index()
    {
        $data = [
            'instansi'=> instance::where('user_id', Session::get('user_id'))->first()
        ];
        return view('Persediaan.Instansi.content', $data);
    }


    public function create()
    {
        $data = [
            'provinsi'=> Provinsi::all(),
            'kabkot'=> KotaProv::all(),
        ];
        return view('Persediaan.Instansi.new', $data);
    }


    public function store(Request $req)
    {
        //

        $this->validate($req,[
           'name_instansi'=>'required',
           'singkatan_instansi'=>'required',
           'alamat'=>'required',
           'id_provinsi'=>'required',
           'id_kab_kota'=>'required',
           'no_telp'=>'required',
           'email'=>'required|unique:tbl_instansi,email|max:255',
           'level_instansi'=>'required',
        ]);

        $request = $req->except(['_token']);
        $request['user_id']=Session::get('user_id');

        $model = new instance($request);
        if($model->save()){
            if($model->LinksToUsers->status_syarat==0){
                $model_users = User::find(Session::get('user_id'));
                $model_users->status_syarat='1';
                $model_users->save();
                return redirect('penentuan-tahun-anggaran')->with('message_success', 'Selanjutnya, menentukan tahun data anggaran');
            }else{
                return redirect('instansi')->with('message_success', 'Anda telah mengisi data instansi anda.');
            }
        }
        return redirect('instansi')->with('message_error', 'ada kesalahan mengisi data instansi anda, mohon periksa kembali.');
    }


    public function edit($id)
    {
        $model = instance::findOrFail($id);
        $data = [
            'provinsi'=> Provinsi::all(),
            'kabkot'=> KotaProv::all()->where('provinsi_id', $model->id_provinsi),
            'instansi'=> $model
        ];
        return view('Persediaan.Instansi.edit', $data);
    }


    public function update(Request $req, $id)
    {
        $this->validate($req,[
            'name_instansi'=>'required',
            'singkatan_instansi'=>'required',
            'alamat'=>'required',
            'id_provinsi'=>'required',
            'id_kab_kota'=>'required',
            'no_telp'=>'required',
            'email'=>'required|unique:tbl_instansi,email|max:255',
            'level_instansi'=>'required',
        ]);

        $request = $req->except(['_token','_method']);
        $model = instance::where('id', $id)->update($request);
        if($model){
            return redirect('instansi')->with('message_success', 'Anda telah mengubah data instansi anda.');
        }

        return redirect('instansi')->with('message_error', 'Ada kesalahan mengubah data instansi anda, mohon periksa kembali.');

    }

    public function upload(Request $req, $id)
    {
        $this->validate($req,[
            'logo'=>'required|image|mimes:jpeg,jpg,png|max:25000',
        ]);

        $gambar= $req->logo;
        $imagename = time() . '.' . $gambar->getClientOriginalExtension();
        $model = instance::findOrFail( $id);

        if(!empty($model->gambar))
        {
            $file_path =public_path('persediaan/logo').'/' . $model->gambar;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        $model->logo = $imagename;
        if($model->save()){
            $gambar->move(public_path('persediaan/logo'), $imagename);
            return redirect('instansi')->with('message_success', 'Upload Logo Berhasil.');
        }
        return redirect('instansi')->with('message_error', 'Gagal Upload Logo. mohon sesuaikan file telah direkomendasikan');

    }

}
