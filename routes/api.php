<?php

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// See Kernel.php for middleware assignment

// Note: this doesn't work if you just enter the endpoint in the URL address bar - you
// actually have to use axios/postman/etc to set up the necessary headers (CSRF token, JWT token, etc).
Route::name('api.')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/user', function (Request $request) {
        dd("DIE");
//        return redirect('profile');
    })->name('user');


    Route::get('/quote', function (Request $request) {
        $process = new Process('cd cgi && java RandomQuoteGenerator');
        $process->run();

        return $process->getOutput();
    })->name('quote');
});
