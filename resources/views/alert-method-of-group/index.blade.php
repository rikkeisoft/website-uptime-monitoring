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
                        <table width="100%" class="table table-striped table-bordered table-hover" id="alert-method-of-group-table">
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
                        </table>
                        <form id="deleteListSelectForm" method="post" action="{{ route('alert-method-of-group.destroy') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input id="checkdelete" name="selectedIds" type="hidden">
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $('#alert-method-of-group-table').DataTable({
                    processing: false,
                    serverSide: true,
                    ordering: false,
                    ajax: "{{ route('alert-method-of-group.search')}}",
                    "columns": [
                        {
                            "data": "id", "orderable": "false", "searchable": "false",
                            "render": function (id) {
                                var inputChecbox = '<input type="checkbox" value="' + id + '" name="selectedIds[]" onClick="toggleIdCheckbox(\'' + id + '\');" />';
                                return inputChecbox;
                            }
                        },
                        {"data": "alert_group.name"},
                        {"data": "alert_method.name"},
                        {"data": "created_at"},
                        {"data": "updated_at"},
                        {
                            "data": "id",
                            "render": function (id) {
                                var editAlertMethofOfGroup = '<a href="/alert-method-of-group/' + id + '/edit" ' + 'class="btn btn-xs btn-primary">' +
                                    '<i class="glyphicon glyphicon-edit"></i> Edit</a>';
                                return editAlertMethofOfGroup;
                            }
                        }
                    ],
                });
            </script>
@endsection