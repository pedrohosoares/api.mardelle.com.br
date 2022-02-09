<?php

namespace App\Observers;

use App\Http\Support\OrderSupport;
use App\Models\Tray\Trayother;

class OrderTrayObserver
{
    /**
     * Handle the Trayother "created" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function creating(Trayother $trayother)
    {

    }

    /**
     * Handle the Trayother "created" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function created(Trayother $trayother)
    {

    }

    /**
     * Handle the Trayother "updated" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function updated(Trayother $trayother)
    {
        //
    }

    /**
     * Handle the Trayother "deleted" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function deleted(Trayother $trayother)
    {
        //
    }

    /**
     * Handle the Trayother "restored" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function restored(Trayother $trayother)
    {
        //
    }

    /**
     * Handle the Trayother "force deleted" event.
     *
     * @param  \App\Models\Trayother  $trayother
     * @return void
     */
    public function forceDeleted(Trayother $trayother)
    {
        //
    }
}
