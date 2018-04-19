<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
//    return view('layouts.app');
    return redirect('/home');
})->middleware('auth');


///////////////
// Admin routes
///////////////
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('users', 'AdminUserController@index');
});
