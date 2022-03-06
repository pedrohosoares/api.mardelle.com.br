<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderServices;
use App\Models\Tray\Traycustomer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderByStatus(Request $request)
    {
        $dateStart = !empty($request->date_start)
        ? $request->date_start : date('Y-m-d', strtotime('-1 month'));
        $dateEnd = !empty($request->date_end)
        ? $request->date_end : date('Y-m-d');
        return OrderServices::orderByStatus($dateStart, $dateEnd);
    }

    public function mapsales(Request $request)
    {
        if ($request->user == 'no') {
            return $this->mapsalesNouser($request);
        } else {
            return $this->mapsaleswithuser($request);
        }
    }

    public function mapsaleswithuser($request)
    {
        if (!getUserLoggedIsAdmin()) {
            $request->user = auth()->user()->id;
        }
        return response()->json(
            Traycustomer::getTotalSalesByAddress(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            ), 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function mapsalesNouser($request)
    {
        if(!getUserLoggedIsAdmin()){
            $request->user =  auth()->user()->id;
        }
        return response()->json(
            Traycustomer::getTotalSalesByAddressNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            ), 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
