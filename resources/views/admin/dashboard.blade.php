@extends('../template_Dashboard')

@section('title')
    Dashboard
@endsection
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $alert_groups }}</div>
                                <div class="text-title">Alert Groups</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('alert-group.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Detail</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $alert_methods }}</div>
                                <div class="text-title">Alert Detail</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('alert-methods.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Detail</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $websites }}</div>
                                <div class="text-title">Total Websites</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('websites.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Detail</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $up_websites }}</div>
                                <div class="text-title">Website Up</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('websites.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Detail</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
@endsection