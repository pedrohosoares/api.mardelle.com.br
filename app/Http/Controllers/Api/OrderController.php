<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderServices;
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
}
