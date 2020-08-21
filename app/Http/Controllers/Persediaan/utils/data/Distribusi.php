<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 21/08/2020
 * Time: 14:20
 */

namespace app\Http\Controllers\Persediaan\utils\data;
use App\Model\Persediaan\Bidang;
use App\Http\Controllers\Persediaan\utils\RenderParsial;
use Session;
class Distribusi
{

    public static function form_data_distribusi($array){
        try{
            $data_bidang = Bidang::all()->where('id_instansi', Session::get('id_instansi'));
            $no = 1;
            $row = array();
            foreach ($data_bidang as $bidang)
            {
                $column = array();
                $column[] = $no++;
                $column[] = $bidang->nama_bidang;
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.form_table_distribusi',
                    array('widget'=> 'tgl')
                );
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.form_table_distribusi',
                    array('widget'=> 'jml_k')
                );
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.form_table_distribusi',
                    array('widget'=> 'status_keluar')
                );
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.form_table_distribusi',
                    array('widget'=> 'ket')
                );
                $column[] = RenderParsial::render_partial('Persediaan.Distribusi.partial.form_table_distribusi',
                    array('widget'=> 'aksi')
                );

                $row[] = $column;
            }
            return array('data_form'=> $row);
        }catch (Throwable $e){
            report($e);
            return false;
        }
    }

}