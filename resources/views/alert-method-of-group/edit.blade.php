@extends('../template_Dashboard')

@section('title')
    Edit Alert Group of Method
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-method-of-group.update', ['alert_method_of_group' => $alertMethodOfGroups->id]) }}" method="POST"  id="form-create">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <legend>  Edit Alert Group of Method </legend>
            <div class="form-group">
                <label for="">Alert Group</label>
                <select class="form-control" id="alert_group_id" name="alert_group_id">
                    <option disabled selected="">{{ $alertMethodOfGroups->alertGroup->name }}</option>
                    @foreach($alertGroups as $alertGroup)
                    <option value="{{ $alertGroup->id }}">{{ $alertGroup->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Alert Method</label>
                <select class="form-control" id="alert_method_id" name="alert_method_id">
                    <option disabled selected=""> {{ $alertMethodOfGroups->alertMethod->name }} </option>
                    @foreach($alertMethods as $alertMethod)
                    <option value="{{ $alertMethod->id }}">{{ $alertMethod->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
@endsection