<?php

namespace App\Http\Controllers\Tray;

use App\Http\ApiTray\Tray;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = new $tray;
    }

    public function get(string $idClient = null) : array
    {
        return $this->tray->get('customers/'.$idClient);
        //zip_code
    }
}
