<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Apps\Provinsi as m_provinsi;

class Provinsi extends Controller
{
    //


    public function getLinkKab(Request $req, $id){
        $data = m_provinsi::find($id)->LinkToKotaProv;
        return response()->json($data);
    }
}
