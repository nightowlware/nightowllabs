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


// Helper for defining simple routes
$defineGetPost = function($name) {
    Route::get("/$name", "HomeController@$name")->name($name);
    Route::post("/$name", "HomeController@{$name}Post")->name("{$name}Post");
};

$defineGetPost('home');
$defineGetPost('crypto');
$defineGetPost('echo');
$defineGetPost('fileshare');
$defineGetPost('checklists');
$defineGetPost('profile');


Route::get('/', function () {
    return redirect('/home');
})->middleware('auth');


///////////////
// Admin routes
///////////////
//Route::prefix('admin')->middleware('admin')->group(function () {
//    Route::get('users', 'AdminUserController@index')->name('admin.users');
//    Route::resource('user', 'AdminUserController');
//});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
