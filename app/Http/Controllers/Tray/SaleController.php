<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;

class SaleController extends Controller
{
    protected $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = $tray;
    }

    public function get(string $saleId = '') : array
    {
        $product = $this->tray->get('products_solds'.$saleId);
        dd($product);
    }
}
