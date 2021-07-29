<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;

class ShareReportModel extends Model
{
    //
    protected $table = 'tbl_share_report';
    protected $guarded =[];

    public function linkToInstance(){
        return $this->belongsTo('App\Model\Persediaan\Instansi','to_id_instansi');
    }

    public function linkToFromInstance(){
        return $this->belongsTo('App\Model\Persediaan\Instansi','from_id_instansi');
    }
}
