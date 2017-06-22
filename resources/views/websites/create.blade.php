@extends('common/dashboard')

@section('title')
    Add Website
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_messages')

            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">Add Website</h1>
            </div>
            <div style="margin: 20px 0">
                <a href="{{ route('websites.index') }}"><button type="button" class="btn btn-primary" >List Websites</button></a>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('websites.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Url</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control" name="url" value="{{ old('url') }}" required autofocus>

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        @if(!empty($listAlertGroup))
                        <div class="form-group{{ $errors->has('alert_group_id') ? ' has-error' : '' }}">
                            <label for="alert_group_id" class="col-md-1 control-label">Alert Group</label>

                            <div class="col-md-6">
                                <select id="alertGroupId" class="form-control" name="alert_group_id" value="{{ old('alert_group_id') }}">
                                    @foreach($listAlertGroup as $value)
                                        <option value="{{ $value->id }}" {{ old('alert_group_id')== $value->id?'selected':''  }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('alert_group_id'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('alert_group_id') }}</strong>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('frequency') ? ' has-error' : '' }}">
                            <label for="frequency" class="col-md-1 control-label">frequency</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="frequency" value="{{ old('frequency') }}">
                                    @foreach($listFrequencys as $key => $value)
                                        <option value="{{ $key }}" {{ old('frequency')== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sensitivity') ? ' has-error' : '' }}">
                            <label for="sensitivity" class="col-md-1 control-label">Sensitivity</label>

                            <div class="col-md-6">
                                <select id="sensitivity" class="form-control" name="sensitivity" value="{{ old('sensitivity') }}">
                                    @foreach($listSensitivitys as $key => $value)
                                        <option value="{{ $key }}" {{ old('sensitivity')== $key?'selected':''  }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-1 control-label">Status</label>

                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status" value="{{ old('status') }}">
                                    @foreach($listStatus as $key => $value)
                                        <option value="{{ $key }}" {{ old('status')== $key?'selected':''  }}>{{ $value }}</option>
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
