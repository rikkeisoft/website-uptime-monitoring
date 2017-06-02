@extends('../template_Dashboard')

@section('title')
    Create Alert Group - Alert Method
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-method-of-group.store') }}" method="post"  id="form-create">
            {{ csrf_field() }}
            <legend>Create Alert Group - Alert Method</legend>
            <div class="form-group">
                <label for="">Alert Group</label>
                <select class="form-control" id="alert_group_id" name="alert_group_id">
                    @foreach($alertGroup as $alertGroups)
                        <option value="{{ $alertGroups->id }}">{{ $alertGroups->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Alert Method</label>
                <select class="form-control" id="alert_method_id" name="alert_method_id">
                    @foreach($alertMethod as $alertMethods)
                        <option value="{{ $alertMethods->id }}">{{ $alertMethods->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
