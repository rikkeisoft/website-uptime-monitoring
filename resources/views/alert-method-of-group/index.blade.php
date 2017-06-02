@extends('../template_Dashboard')

@section('title')
    Alert Method - Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <form id="destroyForm" role="form" method="POST" action="{{ route('destroyMethodOfGroup') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        <a class="btn green btn-success" href="{{ route('alert-method-of-group.create') }}"><span>Add New </span><i class="fa fa-plus"></i></a>
                        <button class="btn red btn btn-danger" id="SubmitDelete" disabled>Remove selected</button>
                    </div>
                </div>
            </div>
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select_all" name="checkbox[]" data-id="checkbox" value="option3"></th>
                    <th>Alert Group</th>
                    <th>Alert Method</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alertMethodOfGroups as $alertMethodOfGroup)
                    <tr>
                        <td><input class="checkbox" value="{!! $alertMethodOfGroup->id !!}" type="checkbox" name="selectedIds[]" onclick="clickCheckbox();"></td>
                        <td>{{ $alertMethodOfGroup->alertGroup->name }}</td>
                        <td>{{ $alertMethodOfGroup->alertMethod->name }}</td>
                        <td>{{ $alertMethodOfGroup->created_at }}</td>
                        <td>{{ $alertMethodOfGroup->updated_at }}</td>
                        <td>
                            <a type="button" class="btn btn-primary btn-sm"href="{{ route('alert-method-of-group.edit', ['alert_method_of_group' => $alertMethodOfGroup->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/check-all-buton.js')}}"></script>
 @endsection
