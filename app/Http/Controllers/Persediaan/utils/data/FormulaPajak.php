<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 13/01/2021
 * Time: 20:07
 */

namespace App\Http\Controllers\Persediaan\utils\data;


class FormulaPajak
{
    public static function formula_pajak($total, $status_ppn=0, $status_pph=0){
        $total_ppn=0;
        $total_pph=0;

        if($status_ppn==1){
            $total_ppn = $total*0.1;
        }

        if($status_pph==1){
            $total_pph = $total*0.015;
        }

        $data_pajak = new \stdClass();
        $data_pajak->total = $total;
        $data_pajak->total_ppn = $total_ppn;
        $data_pajak->total_pph = $total_pph;
        $total = $total+$total_ppn+$total_pph;
        return $total;
    }
}