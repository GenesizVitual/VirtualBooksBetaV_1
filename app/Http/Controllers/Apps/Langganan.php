<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\Instansi;
class Langganan extends Controller
{

    public function index(){
        $data = [
            'instansi'=> Instansi::paginate(20)
        ];
        return view('Admin.langganan.content', $data);
    }

    public function show($id){
        $model = Instansi::findOrFail($id);
        return view('Admin.langganan.detail', ['data'=>$model]);
    }

    public function update(Request $req, $id){
        $this->validate($req,[
            'trial_aktif'=> 'required'
        ]);

        $model = Instansi::findOrFail($id);
        $model->trial_aktif = $req->trial_aktif;
        if($model->save()){
            return redirect('langganan')->with('message_info', 'Status Telah diubah');
        }else{
            return redirect('langganan')->with('message_error', 'Status gagal diubah');
        }
    }

}
