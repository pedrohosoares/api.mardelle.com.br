<?php

namespace App\Http\Services;

use App\Models\Other;

class OtherServices
{

    public static function get($name) : array
    {
        return Other::where('field',$name)->first()->toArray();
    }

    public static function save($name, $json): void
    {
        Other::updateOrCreate(
            ['field' => $name],
            ['value' => json_encode($json,JSON_UNESCAPED_UNICODE)]
        );
    }
}
