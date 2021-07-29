<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Persediaan\ShareReportModel;
use Session;
use App\Model\Apps\Provinsi;

class ShareReport extends Controller
{
    //
    # Todo: Berbagi Laporan
    public function share_report()
    {
        $data = [
            'share_from'=> ShareReportModel::where('from_id_instansi', Session::get('id_instansi'))->orderBy('from_id_instansi')->get(),
            'share_to'=> ShareReportModel::where('to_id_instansi', Session::get('id_instansi'))->orderBy('to_id_instansi')->get(),
            'provinsi'=>Provinsi::all()->sortBy('provinsi'),
        ];
        return view('Persediaan.laporan.share_report.content', $data);
    }

    public function store(Request $req)
    {
         $this->validate($req, [
            'to_id_instansi' => 'required',
        ]);
        $model = ShareReportModel::updateOrCreate(
            [
                'from_id_instansi' => Session::get('id_instansi'),
                'to_id_instansi' => $req->to_id_instansi,
            ]
        );
        if ($model->save()) {
            return redirect('berbagi-laporan')->with('message_info', 'Anda telah memberikan izin untuk melihat laporan kepada
            skpd '. $model->linkToInstance->name_instansi);
        }
    }
}
