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
                                    <th>Sensitivity</th>
                                    <th>Status</th>
                                    <th>Frequency</th>
                                    <th>Create By</th>
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
                                        <td>{{ $listSensitivity[$website->sensitivity] }}</td>
                                        <td>{{ $listStatus[$website->status] }}</td>
                                        <td>{{ $listFrequency[$website->frequency] }}</td>
                                        <td>{{ $website->user->username }}</td>
                                        <td>{{ $website->created_at }}</td>
                                        <td class="center"><a href="{{ $url=action('WebsitesController@update',$website->id) }}"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-danger" id="SubmitDelete" disabled >Delete</button>
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