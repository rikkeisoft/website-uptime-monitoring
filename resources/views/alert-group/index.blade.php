@extends('../template_Dashboard')
@section('title')
    Alert Group
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a class="btn green btn-success" href="{{ route('alert-group.create') }}"><span>Add New </span><i class="fa fa-plus"></i></a>
                    <button class="btn red btn btn-danger" id="SubmitDelete" disabled>Remove selected</button>
                </div>
            </div>
        </div>
        <form id="destroyAlertGroupForm" role="form" method="POST" action="{{ route('destroyAlertGroup') }}">
            {{ csrf_field() }}
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select_all" name="checkbox[]" data-id="checkbox" value="option3">
                    </th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($alertGroups as $alertGroup)
                    <tr>
                        <td>
                            <input class="checkbox" type="checkbox" name="alertGroupIds[]" onclick="clickCheckbox();" value="{!! $alertGroup->id !!}">
                        </td>
                        <td>{{ $alertGroup->name }}</td>
                        <td>{{ $alertGroup->created_at }}</td>
                        <td>{{ $alertGroup->updated_at }}</td>
                        <td>
                            <a type="button" class="btn btn-primary btn-sm" href="{{ route('alert-group.edit', ['alert_group' => $alertGroup->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/checkAllButton.js')}}"></script>
@endsection