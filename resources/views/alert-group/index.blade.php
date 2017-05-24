@extends('../template_Dashboard')

@section('title')
Alert Group
@endsection
@section('content')
<div id="page-wrapper">
    <h1>List Alert Groups</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" id="checkAll" value="option3"></th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $key)
        <tr>
            <td><input type="checkbox" value="option3"></td>
            <td>{{ $key->name }}</td>
            <td>{{ $key->created_at }}</td>
            <td>{{ $key->updated_at }}</td>
            <td>
                <a type="button" class="btn btn-primary btn-sm"href="{!! $key->id !!}">Edit</a>
                <a type="button" class="btn btn-danger btn-sm" href="alert-group/{!! $key->id !!}/delete">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
    <script>
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
@endsection