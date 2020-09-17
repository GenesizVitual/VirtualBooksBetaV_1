<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Persediaan\utils\data\Nota as data_nota;
use App\Model\Persediaan\TBK as tbl_nota;
use App\Model\Persediaan\TBK_NOTA as tbl_tbk_nota;
use Session;

class TBK_NOTA extends Controller
{
    //

    public function show($id)
    {
        try{
            data_nota::$status=true;
            $row = data_nota::data_nota(null);
            $tbk = tbl_nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($id);
            return view('Persediaan.TbkNota.content', ['data'=> $row,'tbk'=> $tbk]);
        }catch (Throwable $e)
        {
            report($e);
            return false;
        }
    }

    public function store(Request $req)
    {
        try
        {
            $this->validate($req,[
                '_token'=> 'required',
                'kode'=> 'required',
                'kode_nota'=> 'required',
            ]);

            foreach ($req->kode_nota as $key=> $value)
            {
                $status_nota = $req->get('status_nota_'.$key);
                if(!empty($status_nota)){
                    if($status_nota[0]==1){
                        $model =tbl_tbk_nota::firstOrCreate(
                            [
                                'id_instansi'=>Session::get('id_instansi'),
                                'id_tbk'=>$req->kode,
                                'id_nota'=>$value
                            ]
                        );
                    }else if($status_nota[0]==0){
                        $model = tbl_tbk_nota::where('id_instansi', Session::get('id_instansi'))->where('id_tbk', $req->kode)->where('id_nota', $value)->first();
                        if(!empty($model)){
                            $model->delete();
                        }
                    }
                }
            }
            return redirect('tbk-nota/'.$req->kode)->with('message_success','Proses telah selesai');
        }catch (Throwable $e)
        {
            return false;
        }
    }

    public function update(Request $req, $id)
    {
        try{

            $this->validate($req,[
                '_token'=>'required',
                'kode'=>'required',
                '_method'=>'required',
                'tbk_nota'=>'required',
            ]);

            $data = tbl_tbk_nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            #mengambil kode nota setelah nota dipindahkan ke tbk yang baru
            $nota = $data->LinkToNota->kode_nota;

            $data->id_tbk = $req->tbk_nota;
            if($data->save()){
                #mengambil kode tbk yang baru setelah nota dipindahkan
                $tbk = $data->LinkToTbk->kode;
                return redirect()->back()->with('message_success', 'Anda telah memindahkan nota: '. $nota.' ke TBK: '.$tbk);
            }else{
                return redirect()->back()->with('message_error', 'Anda telah memindahkan nota:'. $nota);
            }
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

    public function destroy(Request $req, $id)
    {

        try{
            $this->validate($req,[
               'kode'=> 'required',
                '_token'=> 'required',
                '_method'=> 'required',
            ]);

            $model = tbl_tbk_nota::where('id_instansi', Session::get('id_instansi'))->findOrFail($req->kode);
            if($model->delete()){
                return redirect()->back()->with('message_success', 'Anda telah memutuskan hubungan nota dengan TBK: '.$model->LinkToTbk->kode);
            }else{
                return redirect()->back()->with('message_error', 'Gagal, menghapus hubungan tbk dengan nota:'.$model->LinkToNota->kode_nota);
            }
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }
}
