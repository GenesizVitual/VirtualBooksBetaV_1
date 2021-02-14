<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Apps\Dokumentasi as documentasi;

class Dokumentasi extends Controller
{
    //
    public function index(){
        $data = [
            'data'=>documentasi::orderBy('no_urut','asc')->paginate(10)
        ];
        return view('Admin.dokumen.content', $data);
    }

    public function show($id){
        $data = documentasi::findOrFail($id);
        return view('Admin.dokumen.detail', ['data'=> $data]);
    }

    public function create(){
        $count_kontent = documentasi::count('id')+1;
        return view('Admin.dokumen.create', ['no_urut'=> $count_kontent]);
    }

    public function store(Request $req){
        $this->validate($req,[
            'no_urut'=>'required',
            'judul'=>'required',
            'dokumentasi'=>'required',
        ]);

        $model = documentasi::updateOrCreate(
            [
                'no_urut'=>$req->no_urut,
            ],
            [
                'judul'=> $req->judul,
                'konten'=>$req->dokumentasi
            ]
        );
        if ($model){
            return redirect('dokumentasi')->with('message_info','Dokumentasi telah dipublish');
        }else{
            return redirect('dokumentasi')->with('message_error','Dokumentasi gagal dipublish');
        }
    }

    public function edit($id){
        $data = documentasi::findOrFail($id);
        return view('Admin.dokumen.edit', ['data'=> $data]);
    }

    public function delete($id){
        $data = documentasi::findOrFail($id);
        if($data->delete()){
            return redirect('dokumentasi')->with('message_info','Dokumentasi dengan judul :'.$data->judul.' telah dihapus');
        }else{
            return redirect('dokumentasi')->with('message_error','Dokumentasi dengan judul :'.$data->judul.' gagal dihapus');
        }
    }

    public function upload(Request $request)
    {   if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('dokument_image'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('dokument_image/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
