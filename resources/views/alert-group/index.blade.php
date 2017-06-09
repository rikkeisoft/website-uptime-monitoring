@extends('../template_Dashboard')
@section('title')
    List Alert Groups
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')
            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">List Alert Groups</h1>
                <div style="margin: 20px 0">
                    <a href="{{ route('alert-group.create') }}">
                        <button type="button" class="btn btn-primary">Add Alert Group</button>
                    </a>
                    <button type="button" class="btn btn-danger btn-danger-website" id="SubmitDelete" disabled>Delete</button>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="alert-groups-table">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all" /></th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Update</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td>afafaf</td>
                            </tr>
                            </tbody>
                        </table>
                        <form id="deleteListSelectForm" method="post" action="{{ route('alert-group.destroy') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input id="checkdelete" name="selectedIds" type="hidden">
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $('#alert-groups-table').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: "{{ route('alert-group.search')}}",
                    autoFill: true,
                    order: false,
                    aaSorting: false,
                    "columns": [
                        {
                            "data": "id",
                            "render": function (id) {
                                var inputChecbox = '<input type="checkbox" value="' + id + ' name="selectedIds[]" onClick="toggleIdCheckbox(\''+ id + '\');" />';
                                return inputChecbox;
                            }
                        },
                        {"data": "name"},
                        {"data": "created_at"},
                        {"data": "updated_at"},
                        {
                            "data": "id",
                            "render": function (id) {
                                var editAlertGroup = '<a href="/alert-group/' + id + '/edit" ' + 'class="btn btn-xs btn-primary">' +
                                    '<i class="glyphicon glyphicon-edit"></i> Edit</a>';
                                return editAlertGroup;
                            }
                        }
                    ]
                });
            </script>
@endsection