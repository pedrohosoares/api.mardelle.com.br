<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;
use App\Models\Paymentform;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = new $tray;
    }

    public function get(string $paymentId = '')
    {
        $payments = $this->tray->get('/payments/'.$paymentId);
    }
    public function getByDatabase(string $paymentId = '') : JsonResponse
    {
        return response()->json(
            Paymentform::select(['id','name'])->get(),
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
