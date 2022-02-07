<?php
namespace App\Http\Support;

class TotalMoneyDateCompleteSupport{

    public static function completeStartAndEndDate(array $mounths) : array
    {
        return collect($mounths)->map(function($mounth){
            $dateStart = date('Y-'.$mounth.'-01');
            $dateEnd = date('Y-m-d',strtotime('+1 month -1day',strtotime($dateStart)));
            return [$dateStart,$dateEnd];
        })->toArray();
    }

}
