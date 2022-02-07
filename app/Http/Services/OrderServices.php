<?php

namespace App\Http\Services;

use App\Http\Support\OrderSupport;
use App\Http\Support\ZipCodeOrganizeSupport;
use App\Models\Tray\Traycustomer;
use App\Models\User;

class OrderServices
{

    public static function orderByStatus(string $dateStart, string $dateEnd)
    {
        $zipCodesUser = User::getZipCodesByUser()->toArray();
        $zipCodes = ZipCodeOrganizeSupport::resetIndexArrayZipCode($zipCodesUser);
        $orderByStatus = Traycustomer::retriveByStatusMoneyPay(
            $zipCodes,
            $dateStart,
            $dateEnd
        );
        return OrderSupport::sumMoneysObject($orderByStatus);
    }

}
