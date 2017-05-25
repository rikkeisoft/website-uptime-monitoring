@extends('../template_Dashboard')

@section('title')
Alert Group
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
            <a class="btn green btn-success" href="/alert-group/create"><span>Add New </span><i class="fa fa-plus"></i></a>
            <button class="btn red btn btn-danger">Remove selected</button></div></div>
    </div>
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
                <a type="button" class="btn btn-primary btn-sm"href="alert-group/{!! $key->id !!}/edit">Edit</a>
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