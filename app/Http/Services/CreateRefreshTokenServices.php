<?php

namespace App\Http\Services;

use App\Http\ApiTray\Tray;
use App\Models\Other;

class CreateRefreshTokenServices
{

    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = $tray;
    }

    public function get() : object
    {
        $data['value'] = $this->tray->post('/auth',$this->tray->getToken());
        $other = Other::updateOrCreate(['field'=>'tray'],$data);
        return $other;
    }

    public function updateToken() : void
    {
        $this->tray->updateToken();
    }

}
