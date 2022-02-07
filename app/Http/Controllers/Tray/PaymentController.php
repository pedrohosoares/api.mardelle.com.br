<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;

class PaymentController extends Controller
{
    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = new $tray;
    }

    public function get(string $paymentId = '') : array
    {
        $payments = $this->tray->get('/payments/'.$paymentId);
        dd($payments);
    }
}
