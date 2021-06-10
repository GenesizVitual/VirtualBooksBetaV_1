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

    public static $pajak = array(
        'ppn' => [
            [
                'label' => 'Pajak PPN 10%',
                'name' => 'ppn',
                'unique' => 'ppn_0',
                'value' => 10,
            ]
        ],
        'pph' => [
            [
                'label' => 'Pajak PPH 1.5%',
                'name' => 'pph',
                'value' => 1.5,
                'unique' => 'pph_1',
            ]
        ],
    );

    public static function formula_pajak($total, $ppn = 0, $pph = 0)
    {
        $total_ppn = 0;
        $total_pph = 0;

        if ($ppn != 0) {
            $total_ppn = $total * ($ppn / 100);
        }

        if ($pph != 0) {
            $total_pph = $total * ($pph / 100);
        }

        $data_pajak = new \stdClass();
        $data_pajak->total = $total;
        $data_pajak->total_ppn = $total_ppn;
        $data_pajak->total_pph = $total_pph;
        $total = $total + $total_ppn + $total_pph;
        return $total;
    }

    public static function cek_pajak($total, $model_notal)
    {
        $total_ppn = 0;
        $total_pph = 0;

        if ($model_notal->ppn != 0.0) {
            $total_ppn = $total * ($model_notal->ppn / 100);
        }

        if ($model_notal->pph != 0.0) {
            $total_pph = $total * ($model_notal->pph / 100);
        }

        $data_pajak = new \stdClass();
        $data_pajak->total = $total;
        $data_pajak->total_ppn = $total_ppn;
        $data_pajak->total_pph = $total_pph;

        return $data_pajak;
    }
}