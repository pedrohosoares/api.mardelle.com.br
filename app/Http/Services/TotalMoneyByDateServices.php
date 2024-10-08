<?php

namespace App\Http\Services;

use App\Http\Support\TotalMoneyDateCompleteSupport;
use App\Http\Support\ZipCodeOrganizeSupport;
use App\Models\Tray\Traycustomer;
use App\Models\User;

class TotalMoneyByDateServices
{

    public static function getTotal(
        string $dateStart,
        string $dateEnd,
        string $paymentsForm,
        string $userId
        ): float
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        $total = Traycustomer::retriveTotalMoneyPay(
            $zipCodes,
            $dateStart,
            $dateEnd,
            $paymentsForm,
            $userId
        );
        return $total;
    }

    public static function getTotalMounths(array $mounths)
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        $newdates = TotalMoneyDateCompleteSupport::completeStartAndEndDate($mounths);
        $total = collect($newdates)->map(function ($dates) use ($zipCodes) {
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

    public static function getTotalByInterval(
        string $dateStart,
        string $dateEnd,
        string $groupBy = 'status',
        string $paymentsForm,
        string $userId
        )
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        return Traycustomer::retriveByDateStatusAndTotalMoneyPay(
            $zipCodes,
            $dateStart,
            $dateEnd,
            $groupBy,
            $paymentsForm,
            $userId
        );

    }
}
