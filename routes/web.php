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

Route::get('logout', 'Auth\LoginController@logout');
Route::get('login/google', 'Auth\GoogleLoginController@redirectToProvider')->name('login');
Route::get('login/google/callback', 'Auth\GoogleLoginController@handleProviderCallback');

Route::middleware(['auth'])->group(function () {

    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@store');

    Route::resource('projects', 'ProjectsController');

    Route::get('/test', function () {
        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Multi day',
            'start' => array(
                'date' => \Carbon\Carbon::today()->toDateString(),
                'timeZone' => 'America/New_York',
            ),
            'end' => array(
                'date' => \Carbon\Carbon::today()->addDays(7)->toDateString(),
                'timeZone' => 'America/New_York',
            ),
            'colorId' => '6'
        ));

        $calService = new \App\Services\GoogleCalendarService(Auth::user());

        $createdEvent = $calService->service->events->insert(
            'ebelusic@gmail.com', $event);

        echo $createdEvent->getId();
    });

    Route::get('/colors', function () {

        $calService = new \App\Services\GoogleCalendarService(Auth::user());

        foreach ($calService->service->colors->get()->getEvent() as $key => $color) {
            echo "<div style='background: {$color->background}; color: {$color->foreground};'>{$key} - background: {$color->background}; foreground: {$color->foreground};</div>";
        }


        die();
    });

    Route::get('/', function () {
        return view('dashboard');
    })->middleware('ensure-calendar-is-set');
});
