<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentFranchiseeController extends Controller
{
    public function get($year = '')
    {
        $year = !empty($year) ? $year : date('Y');
        return view('dashboard.payment_franchisee.index',[

        ]);
    }
}
