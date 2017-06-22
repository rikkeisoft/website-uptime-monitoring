<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>Website Uptime Monitoring</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico')}}">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="container is-fluid">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('dist/js/app.js') }}"></script>
</body>
</html>
