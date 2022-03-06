<?php

namespace App\Observers;

use App\Http\ApiTray\Tray;
use App\Http\Controllers\Tray\TrayTokenController;
use App\Http\Services\CreateRefreshTokenServices;
use App\Models\Tray\Affiliate;

class AffiliateObserver
{

    protected $tray;
    protected $token;

    public function __construct(Tray $tray)
    {
        $this->tray = $tray;
        $this->token = (new TrayTokenController($this->tray));
    }

    /**
     * Handle the Affiliate "created" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function creating(Affiliate $affiliate)
    {
        (new CreateRefreshTokenServices(new Tray))->get();
        $tray = $this->tray->post('/partners',
            [
                "Partner"=>[
                    "name" => $affiliate->name,
                    "site" => $affiliate->site,
                    "commission" => ($affiliate->commission / 100)
                ]
            ]
        );
        $tray = json_decode($tray,true);
        $affiliate['id_external'] = $tray['id'];
        return $affiliate;
    }

        /**
     * Handle the Affiliate "created" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function created(Affiliate $affiliate)
    {
    }

    /**
     * Handle the Affiliate "updated" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function updated(Affiliate $affiliate)
    {
        (new CreateRefreshTokenServices(new Tray))->get();
        $tray = $this->tray->update('/partners',
            [
                "Partner"=>[
                    "name" => $affiliate->name,
                    "site" => $affiliate->site,
                    "commission" => ($affiliate->commission / 100)
                ]
            ]
        );
        return $affiliate;
    }

    /**
     * Handle the Affiliate "deleted" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function deleted(Affiliate $affiliate)
    {
        (new CreateRefreshTokenServices(new Tray))->get();
        $tray = $this->tray->delete('/partners/'.$affiliate->id_external);
        return $affiliate;
    }

    /**
     * Handle the Affiliate "restored" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function restored(Affiliate $affiliate)
    {

    }

    /**
     * Handle the Affiliate "force deleted" event.
     *
     * @param  \App\Models\Affiliate  $affiliate
     * @return void
     */
    public function forceDeleted(Affiliate $affiliate)
    {
        //
    }
}
