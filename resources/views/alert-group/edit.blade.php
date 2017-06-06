@extends('../template_Dashboard')
@section('title')
    Update Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-group.update', ['alert_group' => $alertGroup->id]) }}" method="POST" role="form" id="form-edit">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <legend>Update Alert Group</legend>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="">Name</label>
                <input type="hidden" id="id" name="id" value="{{ $alertGroup->id }}">
                <input type="text" value="{{ $alertGroup->name }}" class="form-control" name="name" id="name" placeholder="Name...">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection