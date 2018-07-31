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
            'Home' => route('home'),
            'Crypto Prices' => route('crypto'),
            'POST Echo Tester' => route('echo'),
            'Profile' => route('profile'),
        ];

        return $ret;
    }

    public function getAdminMenu() : array {
        $ret = [
            'Manage Users' => route('admin.users'),
        ];

        return $ret;
    }
}
