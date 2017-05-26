@extends('../template_Dashboard')

@section('title')
    Edit Alert Group of Method
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ URL::action('AlertMethodAlertGroupController@updateMethodofGroup') }}" method="post"  id="form-create">
            {{ csrf_field() }}
            <legend>  Edit Alert Group of Method </legend>
            <input type="hidden" id="id"name="id" value="{{ $items->id }}">
            <div class="form-group">
                <label for="">Alert Group</label>
                <select class="form-control" id="alert_group_id" name="alert_group_id">
                    <option disabled selected="">{{ $items->alertGroup->name }}</option>
                    @foreach($alertgroups as $key)
                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Alert Method</label>
                <select class="form-control" id="alert_method_id" name="alert_method_id">
                    <option disabled selected="">{{ $items->alertMethod->name }}</option>
                    @foreach($alertmethods as $key)
                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection