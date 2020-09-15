<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 13/08/2020
 * Time: 14:55
 */

namespace App\Http\Controllers\Persediaan\utils;
use View;

class RenderParsial
{
    public static function render_partial($view,$array,$show=false){
        return (string)View::make($view, array('data'=>$array,'show'=> $show));
    }
}