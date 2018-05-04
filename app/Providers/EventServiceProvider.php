<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
//    protected $listen = [
//        'App\Events\UserLogin' => [
//            'App\Listeners\UserLoginListener',
//        ],
//    ];

    protected $listen = [
        'Illuminate\Auth\Events\Attempting' => [
            'App\Listeners\UserLoginListener',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserLoginListener',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\UserLoginListener',
        ],

        'Illuminate\Auth\Events\Lockout' => [
            'App\Listeners\UserLoginListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
