@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Settings</h3>
                </div>
                <div class="panel-body">
                    <form action="/settings" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="calendar_id">Selected Calendar</label>
                            <select name="calendar_id" id="calendar_id" class="form-control">
                                <option value="create_calendar">Projects (will be created)</option>
                                @foreach($calendars as $calendar)
                                    <option value="{{ $calendar->id }}" {{ (Auth::user()->calendar_id == $calendar->id ? 'selected="selected"' : '') }}>{{ $calendar->summary }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label>Sync with Google:</label><br>--}}
                            {{--<label for="sync_with_google_true">--}}
                                {{--<input type="radio" name="sync_with_google" value="1" id="sync_with_google_true" {{ (Auth::user()->sync_with_google ? 'checked="checked"' : '') }}> Yes--}}
                            {{--</label>--}}
                            {{--&nbsp;--}}
                            {{--<label for="sync_with_google_false">--}}
                                {{--<input type="radio" name="sync_with_google" value="0" id="sync_with_google_false" {{ (!Auth::user()->sync_with_google ? 'checked="checked"' : '') }}> No--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection