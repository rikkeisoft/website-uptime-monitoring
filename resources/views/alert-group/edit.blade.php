@extends('../template_Dashboard')

@section('title')
    Edit Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('updateAlertGroup') }}" method="POST" role="form">
            {{ csrf_field() }}
            <legend>Edit Alert Group</legend>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="hidden" id="id" name="id" value="{{$items->id}}">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="{{$items->name}}">
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection