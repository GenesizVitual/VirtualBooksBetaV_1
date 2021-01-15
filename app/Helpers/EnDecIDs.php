<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 14/01/2021
 * Time: 21:21
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Crypt;

class EnDecIDs
{
    public static function getAttribute($key)
    {
        $value = parent::getAttribute($key);
//        $value_ = Crypt::decrypt($value);
        return $value;
    }

    public static function setAttribute($value)
    {
//        $value = Crypt::encrypt($value);
        return $value;
    }
}