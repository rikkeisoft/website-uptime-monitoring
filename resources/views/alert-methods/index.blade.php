@extends('template_Dashboard')

@section('title')
    List Alert Methos|Website Uptime Monitor
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
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all"/></th>
                                <th>Name</th>
                                <th>Alert Group</th>
                                <th>Method</th>
                                <th>Create By</th>
                                <th>Created</th>
                                <th class="center">Update</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listAlertMethods as $alert)
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" name="selectedIds[]" value="{{ $alert->id }}"
                                               onclick="clickCheckbox();"></td>
                                    <td>{{ $alert->name }}</td>
                                    <td>{{ isset($alert->alertmethodalertgroup->alertGroup['name'])?$alert->alertmethodalertgroup->alertGroup['name']:'' }}</td>
                                    <td>{{ $listTypes[$alert->type] }} /
                                        @if($alert->type == 1)
                                            {{ $alert->email }}
                                        @elseif($alert->type == 2)
                                            {{ $alert->phone_number }}
                                        @else
                                            {{ $alert->webhook }}
                                        @endif
                                    </td>
                                    <td>{{ $alert->user->username }}</td>
                                    <td>{{ $alert->created_at }}</td>
                                    <td class="center"><a
                                                href="{{ route('alert-methods.edit', ['alert_method_id' => $alert->id]) }}"><i
                                                    class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $listAlertMethods->render() !!}
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
@endsection