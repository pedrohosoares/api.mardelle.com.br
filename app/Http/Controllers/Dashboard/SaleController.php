<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Services\TotalMoneyByDateServices;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function get(Request $request): View
    {
        redirect404UserNotLogged();
        $dateStart = !empty($request->date_start)
        ? $request->date_start : date('Y-m-d', strtotime('-1 month'));
        $dateEnd = !empty($request->date_end)
        ? $request->date_end : date('Y-m-d');
        $user = !empty($request->user) ? $request->user : "";
        return view('dashboard.sales.index', [
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'user' => $user
        ]);
    }

}
