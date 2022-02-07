<?php

namespace App\Http\Services;

use App\Http\Support\TotalMoneyDateCompleteSupport;
use App\Http\Support\ZipCodeOrganizeSupport;
use App\Models\Tray\Traycustomer;
use App\Models\User;

class TotalMoneyByDateServices
{

    public static function getTotal(string $dateStart,string $dateEnd) : float
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        $total = Traycustomer::retriveTotalMoneyPay(
            $zipCodes,
            $dateStart,
            $dateEnd
        );
        return $total;
    }

    public static function getTotalMounths(array $mounths)
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        $newdates = TotalMoneyDateCompleteSupport::completeStartAndEndDate($mounths);
        $total = collect($newdates)->map(function($dates) use ($zipCodes){
            $dateStart = $dates[0];
            $dateEnd = $dates[1];
            return [
                    $dateStart,
                    Traycustomer::retriveTotalMoneyPay(
                        $zipCodes,
                        $dateStart,
                        $dateEnd
                    ),
            ];
        })->toArray();
        return $total;
    }


}
