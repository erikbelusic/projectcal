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
                                <option value="">Select a calendar</option>
                                @foreach($calendars as $calendar)
                                    <option value="{{ $calendar->id }}" {{ (Auth::user()->calendar_id == $calendar->id ? 'selected="selected"' : '') }}>{{ $calendar->summary }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection