@extends('template_Dashboard')

@section('title')
    Update Website|Website Uptime Monitor
@endsection

@section('content')
    <div id="page-wrapper" style="padding-top: 20px;">
        <div class="row">
            @component('flash_alert_message')

            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">Update Websites</h1>
            </div>
            <div style="margin: 20px 0">
                <a href="{{ route('viewListWebsite') }}"><button type="button" class="btn btn-primary" >List Websites</button></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('updateWebsite') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $website->id }}">
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Url</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control" name="url" value="{{ empty(old('url'))?$website->url:old('url') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ empty(old('name'))?$website->name:old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sensitivity') ? ' has-error' : '' }}">
                            <label for="sensitivity" class="col-md-1 control-label">Sensitivity</label>

                            <div class="col-md-6">
                                <select id="sensitivity" class="form-control" name="sensitivity" value="{{ old('sensitivity') }}">
                                    @foreach($listSensitivity as $key => $value)
                                        <option value="{{ $key }}" {{ $website->sensitivity== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-1 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status" value="{{ old('status') }}">
                                    @foreach($listStatus as $key => $value)
                                        <option value="{{ $key }}" {{ $website->status== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('frequency') ? ' has-error' : '' }}">
                            <label for="frequency" class="col-md-1 control-label">frequency</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="frequency" value="{{ old('frequency') }}">
                                    @foreach($listFrequency as $key => $value)
                                        <option value="{{ $key }}" {{ $website->frequency== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">
                                    Add Website
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection