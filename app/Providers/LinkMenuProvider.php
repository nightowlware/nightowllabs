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
            'Home' => ['url' => route('home'), 'icon' => 'fas fa-home'],
            'Checklists' => ['url' => route('checklists'), 'icon' => 'fas fa-list'],
            'Crypto Prices' => ['url' => route('crypto'), 'icon' => 'fab fa-bitcoin'],
            'POST Echo' => ['url' => route('echo'), 'icon' => 'fas fa-exchange-alt'],
            'EZ File Share' => ['url' => route('fileshare'), 'icon' => 'fas fa-share-square'],
            'Phaser' => ['url' => route('phaser'), 'icon' => 'fas fa-gamepad'],
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
