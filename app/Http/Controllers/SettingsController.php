<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;
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
        Auth::user()->calendar_id = $request->input('calendar_id');
        Auth::user()->sync_with_google = $request->input('sync_with_google');
        Auth::user()->save();

        return redirect('/settings');
    }
}
