@extends('template_Dashboard')

@section('title')
    List Alert Methods
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')

            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">List Alert Methods</h1>
                <div style="margin: 20px 0">
                    <a href="{{ route('alert-methods.create') }}">
                        <button type="button" class="btn btn-primary">Add Alert Methods</button>
                    </a>
                    <button type="button" class="btn btn-danger btn-danger-website" id="SubmitDelete" disabled>Delete
                    </button>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover"
                               id="alert-methods-table">
                            <thead>
                            <tr>
                                <th class="checkAllButon"><input type="checkbox" id="select_all"/></th>
                                <th>Name</th>
                                <th>Alert Group</th>
                                <th>Method</th>
                                <th>Create By</th>
                                <th>Created</th>
                                <th class="center">Update</th>
                            </tr>
                            </thead>
                        </table>
                        <form id="deleteListSelectForm" method="post" action="{{ route('alert-methods.destroy') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input id="checkdelete" name="selectedIds" type="hidden">
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <script>
        $('#alert-methods-table').DataTable({
            processing: false,
            serverSide: true,
            ordering:false,
            ajax: "{{ route('alert-method.search')}}",
            "columns": [
                {
                    "data": "id","orderable": "false", "searchable": "false",
                    "render": function (id) {
                        var inputChecbox = '<input type="checkbox" value="' + id + '" name="selectedIds[]" onClick="toggleIdCheckbox(\''+ id + '\');" />';
                        return inputChecbox;
                    }
                },
                {"data": "name"},
                {"data": "alert_method_alert_group.alert_group_id"},
                {"data": "email"},
                {"data": "created_at"},
                {"data": "updated_at"},
                {
                    "data": "id",
                    "render": function (id) {
                        var editAlertMethod = '<a href="/alert-methods/' + id + '/edit" ' + 'class="btn btn-xs btn-primary">' +
                            '<i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        return editAlertMethod;
                    }
                }
            ],
        });
    </script>
@endsection