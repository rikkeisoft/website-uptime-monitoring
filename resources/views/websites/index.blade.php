@extends('template_Dashboard')

@section('title')
    List Website|Website Uptime Monitor
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            @component('flash_alert_message')

            @endcomponent
            <div class="col-lg-12">
                <h1 class="page-header">List Website</h1>
                <div style="margin: 20px 0">
                    <a href="{{ route('viewAddWebsite') }}"><button type="button" class="btn btn-primary" >Add Website</button></a>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form id="deleteAlertMethodForm" role="form" method="POST" action="{{ route('deleteWebsite') }}">
                            {{ csrf_field() }}
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="select_all"/></th>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Alert Group</th>
                                    <th>Sensitivity</th>
                                    <th>Status</th>
                                    <th>Frequency</th>
                                    <th>Created</th>
                                    <th class="center">Update</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listWebsite as $website)
                                    <tr class="odd gradeX">
                                        <td><input type="checkbox" name="chkCat[]" value="{{ $website->id }}" onclick="clickCheckbox();"></td>
                                        <td>{{ $website->name }}</td>
                                        <td><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></td>
                                        <td>{{ isset($website->monitor->alertGroup->name)?$website->monitor->alertGroup->name:'' }}</td>
                                        <td>{{ $listSensitivity[$website->sensitivity] }}</td>
                                        <td><button type="button" onclick="checkEnable('{{ $website->id }}', '{{ $website->status }}')" class="btn btn-sm {{ $website->status == 1?'btn-primary':'btn-danger' }}" >{{ $listStatus[$website->status] }}</button></td>
                                        <td>{{ $listFrequency[$website->frequency] }}</td>
                                        <td>{{ $website->created_at }}</td>
                                        <td class="center"><a href="{{ $url=action('WebsitesController@update',$website->id) }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-danger" id="SubmitDelete" disabled >Delete</button>
                        </form>
                        <form id="checkEnableDisable" method="post" action="{{ route('setStatusWebsite') }}">
                            <input id="checkEnableDisableID" name="id" type="hidden">
                            <input id="checkEnableDisableStatus" name="status" type="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <script src="{{ asset('js/website.js')}}"></script>
    </div>
@endsection