<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;

class ProductSoldController extends Controller
{
    protected $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = $tray;
    }

    public function getSpecific(string $productSoldId) : array
    {
        return $this->tray->get("products_solds/{$productSoldId}");
    }
}
