<?php

use Illuminate\Http\Request;

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
Route::get('/user', function (Request $request) {
    return $request->user();
});
