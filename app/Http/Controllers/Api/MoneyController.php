<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\TotalMoneyByDateServices;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    public function total(Request $request) : float
    {
        $dateStart = !empty($request->date_start)
        ? $request->date_start : date('Y-m-d', strtotime('-1 month'));
        $dateEnd = !empty($request->date_end)
        ? $request->date_end : date('Y-m-d');
        $paymentsForm = !empty($request->payments_form) ? $request->payments_form : '';
        $userId = !empty($request->user_id) ? $request->user_id : '';
        return TotalMoneyByDateServices::getTotal(
            $dateStart,
            $dateEnd,
            $paymentsForm,
            $userId
        );
    }

    public function totalMounth(Request $request)
    {
        return TotalMoneyByDateServices::getTotalMounths(explode(',',$request->mounths));
    }

    public function totalByInterval(Request $request)
    {
        if(!$request->has('mounths'))
        {
            exit;
        }
        $dates = explode(',',$request->mounths);
        $paymentsForm = !empty($request->payments_form) ? $request->payments_form : '%';
        $userId = !empty($request->user_id) ? $request->user_id : '%';
        return TotalMoneyByDateServices::getTotalByInterval(
            $dates[0],
            $dates[1],
            'status',
            $paymentsForm,
            $userId
        );
    }

    public function totalByPaymentInterval(Request $request)
    {
        if(!$request->has('mounths'))
        {
            exit;
        }
        $paymentsForm = !empty($request->payments_form) ? $request->payments_form : '%';
        $userId = !empty($request->user_id) ? $request->user_id : '%';
        $dates = explode(',',$request->mounths);
        return TotalMoneyByDateServices::getTotalByInterval(
            $dates[0],
            $dates[1],
            'payment_form',
            $paymentsForm,
            $userId
        );
    }
}
