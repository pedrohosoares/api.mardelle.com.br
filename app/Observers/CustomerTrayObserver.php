<?php

namespace App\Observers;

use App\Models\Tray\Traycustomer;

class CustomerTrayObserver
{
    /**
     * Handle the Traycustomer "created" event.
     *
     * @param  \App\Models\Traycustomer  $traycustomer
     * @return void
     */
    public function created(Traycustomer $traycustomer)
    {

    }

    /**
     * Handle the Traycustomer "creating" event.
     *
     * @param  \App\Models\Tray\Traycustomer  $traycustomer
     * @return void
     */
    public function creating(Traycustomer $traycustomer)
    {
        $traycustomer['zip_code'] = str_replace('-','',$traycustomer['zip_code']);
        return $traycustomer;
    }

    /**
     * Handle the Traycustomer "updating" event.
     *
     * @param  \App\Models\Tray\Traycustomer  $traycustomer
     * @return void
     */
    public function updating(Traycustomer $traycustomer)
    {
        $traycustomer['zip_code'] = str_replace('-','',$traycustomer['zip_code']);
        return $traycustomer;
    }

    /**
     * Handle the Traycustomer "updated" event.
     *
     * @param  \App\Models\Traycustomer  $traycustomer
     * @return void
     */
    public function updated(Traycustomer $traycustomer)
    {
        //
    }

    /**
     * Handle the Traycustomer "deleted" event.
     *
     * @param  \App\Models\Traycustomer  $traycustomer
     * @return void
     */
    public function deleted(Traycustomer $traycustomer)
    {
        //
    }

    /**
     * Handle the Traycustomer "restored" event.
     *
     * @param  \App\Models\Traycustomer  $traycustomer
     * @return void
     */
    public function restored(Traycustomer $traycustomer)
    {
        //
    }

    /**
     * Handle the Traycustomer "force deleted" event.
     *
     * @param  \App\Models\Traycustomer  $traycustomer
     * @return void
     */
    public function forceDeleted(Traycustomer $traycustomer)
    {
        //
    }
}
