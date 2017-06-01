@extends('../template_Dashboard')
@section('title')
    Create Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-group.store') }}" method="post"  id="form-create">
            {{ csrf_field() }}
            <legend>Create Alert Group</legend>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control"  name="name" id="name" placeholder="Name...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/validator-CreateAlertGroup.js')}}"></script>
@endsection