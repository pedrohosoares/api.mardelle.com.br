<?php
namespace App\Http\Support;

class TrayortherSupport
{
    public static function putZeroValueInResultNull($value)
    {
        if($value == null or $value == 'null')
        {
            return 0;
        }else{
            return $value;
        }
    }
}
