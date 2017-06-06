@extends('../template_Dashboard')
@section('title')
    Add Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-group.store') }}" method="post" id="form-create">
            {{ csrf_field() }}
            <legend>Add Alert Group</legend>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="{{ old('name') }}">
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