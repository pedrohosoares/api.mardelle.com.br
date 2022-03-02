<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tray\Trayother;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function salesByPaymentForm() : object
    {
        return Trayother::get()->groupBy('payment_form');
    }

    public function salesByStatus() : object
    {
        return Trayother::get()->groupBy('status');
    }
}
