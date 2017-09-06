<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            padding-top: 80px;
        }

        [v-cloak] {
            display: none;
        }

        .vdp-datepicker .form-control {
            background-color: white;
        }

        .history-row {
            position: absolute;
            left: 0;
            /*padding: 10px;*/
        }

        .history-row .list-group {
            margin: 9px 0 0 8px;
        }

        table.table {
            position: relative;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-brand">Workstreams</div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>

    </div>
</nav>
<div class="container-fluid">
    @yield('content')
    <script src="{{ mix('/js/app.js') }}"></script>
</div>
</body>
</html>