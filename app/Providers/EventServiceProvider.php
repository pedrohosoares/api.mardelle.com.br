<?php

namespace App\Providers;

use App\Models\Location;
use App\Models\Tray\Affiliate;
use App\Models\Tray\Traycustomer;
use App\Models\User;
use App\Observers\AffiliateObserver;
use App\Observers\CustomerTrayObserver;
use App\Observers\LocationObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Traycustomer::observe(CustomerTrayObserver::class);
        Location::observe(LocationObserver::class);
        Affiliate::observe(AffiliateObserver::class);
        User::observe(UserObserver::class);
    }
}
