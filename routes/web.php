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


// Helper for defining simple "home" routes
function defineHomeRoute($name) {
    Route::get("/$name", "HomeController@$name")->name($name);
}

defineHomeRoute('home');
defineHomeRoute('crypto');
defineHomeRoute('profile');


Route::get('/', function () {
//    return view('layouts.app');
    return redirect('/home');
})->middleware('auth');


///////////////
// Admin routes
///////////////
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('users', 'AdminUserController@index')->name('admin.users');
    Route::resource('user', 'AdminUserController');
});

