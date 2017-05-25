@extends('../template_Dashboard')

@section('title')
    Edit Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ URL::action('AlertGroupController@update',$items->id) }}" method="PUT" role="form">

            <legend>Edit Alert Group</legend>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name..." value="{{$items->name}}">
                </div>
                <div class="form-group">
                    <label for="">User</label>
                    <select class="form-control" disabled>
                        <option id="user_id">{{$items->user->username}}</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection