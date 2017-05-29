@extends('../template_Dashboard')s
@section('title')
    Create Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form action="{{ URL::action('AlertGroupController@store') }}" method="post"  id="form-create">
            {{ csrf_field() }}
            <legend>Create Alert Group</legend>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control"  name="name" id="name" placeholder="Name...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script type="text/javascript">
        $("#form-create").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength:100,
                }
            }
        })
    </script>
@endsection