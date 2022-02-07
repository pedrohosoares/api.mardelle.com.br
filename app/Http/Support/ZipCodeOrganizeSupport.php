<?php
namespace App\Http\Support;

class ZipCodeOrganizeSupport{

    public static function resetIndexArrayZipCode(array $zipcodes) : array
    {
        return collect($zipcodes)->map(function($value){
            return [$value['zip_code_start'],$value['zip_code_end']];
         })->toArray();
    }

}
