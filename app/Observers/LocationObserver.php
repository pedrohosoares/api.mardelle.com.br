<?php

namespace App\Observers;

use App\Models\Location;
use Illuminate\Validation\ValidationException;

class LocationObserver
{
    /**
     * Handle the Location "created" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function created(Location $location)
    {
        //
    }

    /**
     * Handle the Location "updated" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function updated(Location $location)
    {
        //
    }

    /**
     * Handle the Location "deleted" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function deleted(Location $location)
    {
        //
    }

    /**
     * Handle the Location "deleting" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function deleting(Location $location)
    {
        if($location->userLocation->count() > 0)
        {
            throw ValidationException::withMessages([
                'message' =>'Existem franquias nesse endereço, portanto não é possível excluir',
                'alert-type' => 'danger'
            ]);
        }
    }

    /**
     * Handle the Location "restored" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function restored(Location $location)
    {
        //
    }

    /**
     * Handle the Location "force deleted" event.
     *
     * @param  \App\Models\Location  $location
     * @return void
     */
    public function forceDeleted(Location $location)
    {
        //
    }
}
