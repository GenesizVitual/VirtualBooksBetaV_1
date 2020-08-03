<?php

namespace App\Model\Apps;

use Illuminate\Database\Eloquent\Model;

class KotaProv extends Model
{

    protected $table = "kotaprov";

    protected $fillable = ['nama','level','provinsi_id'];

}
