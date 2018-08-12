<?php

use Illuminate\Foundation\Inspiring;
use App\Mail\TestMail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('testMail', function() {
    echo("Sending email ...\n");
    Mail::to(env('SUPER_USERS'))->send(new TestMail());
    echo("Done.\n");
})->describe('Send a test-email to the configured Super Users.');
