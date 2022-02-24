<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;
use App\Models\Tray\Affiliate;
use App\Models\Tray\Trayother;

class AffiliateController extends Controller
{
    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = new $tray;
    }

    public function show(int $partner_id)
    {
        $tray = $this->tray->get('orders','&partner_id='.$partner_id);
        foreach($tray['Orders'] as $order)
        {
            $order = $order['Order'];
            $register = Trayother::where('order_id',$order['id'])->first();
            dump($register);
        }
    }

    public function get(string $partnerId = '')
    {
        $tray = $this->tray->get('partners'.$partnerId,'');
        $this->create($tray);
    }

    public function create(array $data) : void
    {
        $partners = $data['Partners'];
        foreach($partners as $value)
        {
            $value = $value['Partner'];
            Affiliate::updateOrCreate(
                ['id_external' => $value['id']],
                [
                    'id_external' => $value['id'],
                    'site' => $value['site'],
                    'name' => $value['name'],
                    'commission' => $value['commission']
                ]
            );
        }
    }
}
