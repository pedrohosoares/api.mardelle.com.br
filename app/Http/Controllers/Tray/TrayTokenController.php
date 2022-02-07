<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;
use App\Http\Services\CreateRefreshTokenServices;

class TrayTokenController extends Controller
{

    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = (new CreateRefreshTokenServices($tray));
    }

    public function get() : object
    {
        return $this->tray->get();
    }

    public function updateToken() : void
    {
        $this->tray->updateToken();
    }
}
