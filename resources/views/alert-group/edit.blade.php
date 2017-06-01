@extends('../template_Dashboard')
@section('title')
    Edit Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ route('alert-group.update', ['alert_group' => $alertGroup->id]) }}" method="POST" role="form" id="form-edit">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <legend>Edit Alert Group</legend>
            <div class="form-group">
                <label for="">Name</label>
                <input type="hidden" id="id" name="id" value="{{ $alertGroup->id }}">
                <input type="text" value="{{ $alertGroup->name }}" class="form-control" name="name" id="name" placeholder="Name...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/validator-EditAlertGroup.js')}}"></script>
@endsection