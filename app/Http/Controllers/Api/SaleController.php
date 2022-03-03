<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tray\Trayother;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function salesByPaymentForm(Request $request)
    {
        return Trayother::getOrdersByUserTotalPaymentForm(
            $request->user,
            $request->date_start,
            $request->date_end,
            $request->payments_form
        );
    }

    public function salesByStatus(Request $request)
    {
        return Trayother::getOrdersByUserTotalStatus(
            $request->user,
            $request->date_start,
            $request->date_end,
            $request->payments_form
        );
    }

    public function getOrdersByUserTotalSale(Request $request)
    {
        return Trayother::getOrdersByUserTotalSale(
            $request->user,
            $request->date_start,
            $request->date_end,
            $request->payments_form
        );
    }

    public function getMediumTicket(Request $request)
    {
        return Trayother::getOrdersByUserTicketMedium(
            $request->user,
            $request->date_start,
            $request->date_end,
            $request->payments_form
        );
    }

    public function getOrdersByUserId(Request $request)
    {
        return Trayother::getOrdersByUserId(
            $request->user,
            $request->date_start,
            $request->date_end,
            $request->payments_form
        );
    }


}
