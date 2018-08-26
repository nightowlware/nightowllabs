<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LinkMenuProvider extends ServiceProvider
{
    public function __construct($app) {
        parent::__construct($app);
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('usermenu', function($app) {
            return (new self($app))->getUserMenu();
        });

        $this->app->singleton('adminmenu', function($app) {
            return (new self($app))->getAdminMenu();
        });
    }

    /**
     * Register services.
     * @return void
     */
    public function register()
    {
    }

    public function getUserMenu() : array {
        $ret = [
            'Home' => ['url' => route('home'), 'icon' => 'fa-home'],
            'Crypto Prices' => ['url' => route('crypto'), 'icon' => 'fa-bitcoin'],
            'POST Echo' => ['url' => route('echo'), 'icon' => 'fa-exchange'],
            'EZ File Share' => ['url' => route('fileshare'), 'icon' => 'fa-share-square'],
        ];

        return $ret;
    }

    public function getAdminMenu() : array {
        $ret = [
//            'Manage Users' => route('admin.users'),
        ];

        return $ret;
    }
}
