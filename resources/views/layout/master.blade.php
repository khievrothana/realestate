
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Real Managerment | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/sweetAlert/sweetalert.css')}}" rel="stylesheet" />
    <link href="{{asset('css/Iframe.css')}}" rel="stylesheet" /> 
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />
    <link href="{{asset('css/basic.css')}}" rel="stylesheet" /> 
    @yield('css')
</head>
<body>
    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span><b>Real Managerment </b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="active treeview">
                        <a href="{{ url('administrator')}}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                        </a>
                    </li>
                    <li class="treeview menu-property">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Property</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu ">
                            <li><a href="{{ url('administrator/property')}}"><i class="fa fa-circle-o"></i> Listing</a></li>
                            <li><a href="{{ url('administrator/property/addnew')}}"><i class="fa fa-circle-o"></i> Add New</a></li>
                            <li><a href="{{ url('administrator/property/type')}}"><i class="fa fa-circle-o"></i> Property Type</a></li>
                            <li><a href="{{ url('administrator/property/feature')}}"><i class="fa fa-circle-o"></i> Property Feature</a></li>
                            <li><a href="{{ url('administrator/property/location')}}"><i class="fa fa-circle-o"></i> Property Location</a></li>
                        </ul>
                    </li>
                    <li class="menu-image">
                        <a href="{{ url('administrator/image')}}">
                            <i class="fa fa-calendar"></i> <span>Image</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Agents</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Listing</a></li>
                            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> AddnNew</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/calendar.html">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <small class="label pull-right bg-red">3</small>
                        </a>
                    </li>
                    <li>
                        <a href="pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-right bg-yellow">12</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        </ul>
                    </li>
           
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
           @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/Plugins/jquery-1.11.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Plugins/bootstraps/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src='{{asset("js/Plugins/sweetalert/sweetalert.min.js")}}'></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Iframe.js')}}"></script>
    @yield('javascript')
</body>
</html>
