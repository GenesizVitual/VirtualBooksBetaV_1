<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Apps\KotaProv;
class KabKota extends Controller
{
    //
    public function show($id_provinsi){
        $model = KotaProv::where('provinsi_id',$id_provinsi)->get();
        return response()->json($model);
    }
}
