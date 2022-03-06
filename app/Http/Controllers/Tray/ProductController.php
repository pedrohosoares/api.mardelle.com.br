<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;

class ProductController extends Controller
{

    protected $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = $tray;
    }

    public function get() : array
    {
        $products = $this->tray->get('products');
        dd($products);
    }

    public function getSpecific($id) : array
    {
        $products = $this->tray->get("products/{$id}");
        dd($products);
    }

}
