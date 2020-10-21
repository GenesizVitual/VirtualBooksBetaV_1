<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 21/10/2020
 * Time: 22:01
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use Session;
use App\Http\Controllers\Persediaan\utils\data\Nota;
use App\Model\Persediaan\JenisTbk;

class RekapitulasiPersediaan
{
    public static $tgl_awal;
    public static $tgl_akhir;

    public static function DataRekapitupitulasi($array){
        try{
            $model = JenisTbk::all()->where('id_instansi', Session::get('id_instansi'))->sortBy('status_pembayaran');
            $array = [];
            foreach ($model as $data){
                Nota::$id_jenis_nota = $data->id;
                Nota::$status = true;
                Nota::$tgl_awal = self::$tgl_awal;
                Nota::$tgl_akhir = self::$tgl_akhir;
                $array[$data->id] = Nota::data_nota(null);
            }
            return $array;
        }catch (Throwable $e){
            return false;
        }
    }
}