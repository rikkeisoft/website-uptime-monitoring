@extends('template_Dashboard')

@section('title')
    Admin|Website Uptime Monitor
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')

            @endcomponent
        </div>
    </div>
@endsection