<?php

namespace App\Model\Persediaan;

use Illuminate\Database\Eloquent\Model;
use App\Model\Persediaan\Gudang;
use App\Model\Persediaan\Bidang;

class PengeluaranBarang extends Model
{
    // Ngga Dipakei
    protected $table = 'tbl_pengeluaran_barang';

    public function getBarang()
    {
        return $this->belongsTo(Gudang::class,'id_gudang');
    }

    public function getBidang()
    {
        return $this->belongsTo(Bidang::class,'id_bidang');
    }
}
