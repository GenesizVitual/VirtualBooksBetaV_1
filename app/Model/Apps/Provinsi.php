<?php

namespace App\Model\Apps;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //

    protected $table = "provinsi";

    protected $fillable = ['nama'];

    public function LinkToKotaProv()
    {
        return $this->hasMany('App\Model\Apps\KotaProv', 'provinsi_id', 'id');
    }

}
