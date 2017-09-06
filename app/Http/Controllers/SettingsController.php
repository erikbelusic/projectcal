<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;
use Google_Service_Calendar_Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $calendars = (new GoogleCalendarService(Auth::user()))->calendars();
        return view('settings.index', compact('calendars'));
    }

    public function store(Request $request)
    {
        $calendarId = $request->input('calendar_id');

        if ($request->input('calendar_id') == 'create_calendar') {
            $gCalendar = new Google_Service_Calendar_Calendar();
            $gCalendar->setSummary('Projects');
            $calendar = (new GoogleCalendarService(Auth::user()))->newCalendar($gCalendar);
            $calendarId = $calendar->getId();
        }

        Auth::user()->calendar_id = $calendarId;
        Auth::user()->save();

        return redirect('/');
    }
}
