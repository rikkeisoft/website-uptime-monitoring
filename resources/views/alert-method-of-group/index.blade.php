@extends('../template_Dashboard')
@section('title')
    List Alert Method Of Groups
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')
            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">List Alert Method Of Groups</h1>
                <div style="margin: 20px 0">
                    <a href="{{ route('alert-method-of-group.create') }}">
                        <button type="button" class="btn btn-primary">Add New</button>
                    </a>
                    <button type="button" class="btn btn-danger btn-danger-website" id="SubmitDelete" disabled>Delete</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="alert-MethodOfGroup-table">
                            <thead>
                            <tr>
                                <th class="checkAllButon">
                                    <input type="checkbox" value="option3" id="select_all" name="checkbox[]" data-id="checkbox">
                                </th>
                                <th>Alert Group</th>
                                <th>Alert Method</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th class="center">Update</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alertMethodOfGroup as $alertMethodOfGroups)
                                <tr>
                                    <td>
                                        <input class="checkbox" type="checkbox" name="selectedIds[]" onclick="toggleIdCheckbox();" value="{!! $alertMethodOfGroups->id !!}">
                                    </td>
                                    <td>{{ $alertMethodOfGroups->alertGroup['name'] }}</td>
                                    <td>{{ $alertMethodOfGroups->alertMethod['name'] }}</td>
                                    <td>{{ $alertMethodOfGroups->created_at }}</td>
                                    <td>{{ $alertMethodOfGroups->updated_at }}</td>
                                    <td class="center">
                                        <a href="{{ route('alert-method-of-group.edit', ['alert_method_of_group' => $alertMethodOfGroups->id]) }}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $alertMethodOfGroup->render() !!}
                        <form id="deleteListSelectForm" method="post" action="{{ route('alert-method-of-group.destroy') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input id="checkdelete" name="selectedIds" type="hidden">
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(function () {
                    $('#alert-MethodOfGroup-table').DataTable({
                        "processing": true,
                        "info": true,
                        "bLengthChange": true,
                        "ordering": false,
                    });
                });
            </script>
@endsection