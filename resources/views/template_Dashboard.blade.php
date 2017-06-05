<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{{asset('css/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom style -->
    <link href="{{ asset('css/style.css')}}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->

    <script src="{{ asset('js/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('js/raphael.min.js')}}"></script>

    <script src="{{ asset('js/morris.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/sb-admin-2.js')}}"></script>

    <script src="{{ asset('js/website-uptime-monitoring.js')}}"></script>
</head>
<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Website Uptime Monitoring</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a>
                </li>
                <li><a href="{{ route('register') }}">Register</a>
                </li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Alert Methods<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Alert Groups</a>
                                </li>
                                <li>
                                    <a href="morris.html">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Alert Groups<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Alert Groups</a>
                                </li>
                                <li>
                                    <a href="morris.html">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Alert Method of a Group<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ asset('alert-method-of-group')}}">Alert Method of a Group</a>
                                </li>
                                <li>
                                    <a href="{{ asset('alert-method-of-group')}}">Add New</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Website<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Website</a>
                                </li>
                                <li>
                                    <a href="morris.html">Add New</a>
                                </li>
                            </ul>
                        </li>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('alertmethods.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i>  Alert Methods</a>
                    </li>
                    <li>
                        <a href="{{ route('alert-group.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i>Alert Groups</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Alert Method of a Group<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.html">Alert Method of a Group</a>
                            </li>
                            <li>
                                <a href="morris.html">Add New</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Website<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.html">Website</a>
                            </li>
                            <li>
                                <a href="morris.html">Add New</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Monitor<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.html">Monitor</a>
                            </li>
                            <li>
                                <a href="morris.html">Add New</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->


    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{ asset('js/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('dist/js/sb-admin-2.js')}}"></script>
        <!-- /.navbar-static-side -->
    </nav>
@yield('content')
<!-- /.panel-body -->
    <div class="panel-footer">
    </div>
</div>
</body>

</html>