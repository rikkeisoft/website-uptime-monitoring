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
                        <table width="100%" class="table table-striped table-bordered table-hover" id="alert-group-table">
                            <thead>
                            <tr>
                                <th class="checkAllButon">
                                    <input type="checkbox" value="option3" id="select_all" name="checkbox[]" data-id="checkbox">
                                </th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th class="center">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alertGroups as $alertGroup)
                                <tr>
                                    <td>
                                        <input class="checkbox" type="checkbox" name="selectedIds[]" onclick="toggleIdCheckbox();" value="{!! $alertGroup->id !!}">
                                    </td>
                                    <td>{{ $alertGroup->name }}</td>
                                    <td>{{ $alertGroup->created_at }}</td>
                                    <td class="center">
                                        <a href="{{ route('alert-group.edit', ['alert_group' => $alertGroup->id]) }}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
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
                $(function () {
                    $('#alert-group-table').DataTable({
                        "processing": true,
                        "info": true,
                        "bLengthChange": true,
                        "ordering": false,
                    });
                });
            </script>
@endsection