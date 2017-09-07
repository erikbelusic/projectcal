@extends('layouts.app')
@section('content')
    <style>
        .btn-social {
            position: relative;
            padding-left: 44px;
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-social.btn-lg, .btn-group-lg > .btn-social.btn {
            padding-left: 61px;
        }

        .btn-google {
            color: #fff;
            background-color: #dd4b39;
            border-color: rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Login</h3></div>
            <div class="panel-body">
                <a class="btn btn-block btn-social btn-lg btn-google" href="{{ route('google-login') }}">
                    <span class="fa fa-google"></span>
                    Login in with Google
                </a></div>
        </div>
            <p class="small">Requires Calendar Access<br/>
                --------------------------------<br/>
                Enter at your own risk.......</p>
    </div>
@endsection