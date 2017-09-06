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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login/google', 'Auth\GoogleLoginController@redirectToProvider')->name('google-login');
Route::get('login/google/callback', 'Auth\GoogleLoginController@handleProviderCallback');

Route::middleware(['auth'])->group(function () {

    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@store');

    Route::resource('projects', 'ProjectsController');



    Route::get('/', function () {
        return view('dashboard');
    })->middleware('ensure-calendar-is-set');
});
