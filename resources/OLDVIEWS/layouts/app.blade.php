<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Real Esatate Management System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN LAYOUT FIRST STYLES -->
    <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
    <!-- END LAYOUT FIRST STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('resources/assets/dist/magnific-popup.css')}}">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('resources/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('resources/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('resources/assets/layouts/layout5/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/layouts/layout5/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('css')
    <link href="{{asset('resources/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/css/popup.css')}}" rel="stylesheet" type="text/css" />
   <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <script language="javascript" type="text/javascript">
        function resizeIframe(obj) {

                $("iframe")[0].style.height = $("iframe")[0].contentWindow.document.body.scrollHeight + 'px';

        }
    </script>

    </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN CONTAINER -->
<div class="wrapper">
    <!-- BEGIN HEADER -->
    <header class="page-header">
        <nav class="navbar mega-menu" role="navigation">
            <div class="container-fluid">
                <div class="clearfix navbar-fixed-top">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="toggle-icon">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </span>
                    </button>
                    <!-- End Toggle Button -->
                    <!-- BEGIN LOGO -->
                    <a id="index" class="page-logo" href="{{URL('/')}}">
                        <img src="{{asset('resources/assets/img/Collgur-logo-white.png')}}" alt="Logo" width="220" height="auto">
                    </a>
                    <!-- END LOGO -->
                    <!-- BEGIN SEARCH -->
                    <form class="search" action="extra_search.html" method="GET">
                        <input type="name" class="form-control" name="query" placeholder="Search...">
                        <a href="javascript:;" class="btn submit md-skip">
                            <i class="fa fa-search"></i>
                        </a>
                    </form>
                    <!-- END SEARCH -->
                    <!-- BEGIN TOPBAR ACTIONS -->
                    <div class="topbar-actions">
                        <!-- BEGIN GROUP NOTIFICATION -->
                        <div class="btn-group-notification btn-group" id="header_notification_bar">
                            <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge">7</span>
                            </button>
                            <ul class="dropdown-menu-v2">
                                <li class="external">
                                    <h3>
                                        <span class="bold">12 pending</span> notifications</h3>
                                    <a href="#">view all</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-success md-skip">
                                                                <i class="fa fa-plus"></i>
                                                            </span> New user registered. </span>
                                                <span class="time">just now</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-danger md-skip">
                                                                <i class="fa fa-bolt"></i>
                                                            </span> Server #12 overloaded. </span>
                                                <span class="time">3 mins</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-warning md-skip">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span> Server #2 not responding. </span>
                                                <span class="time">10 mins</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-info md-skip">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </span> Application error. </span>
                                                <span class="time">14 hrs</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-danger md-skip">
                                                                <i class="fa fa-bolt"></i>
                                                            </span> Database overloaded 68%. </span>
                                                <span class="time">2 days</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-danger md-skip">
                                                                <i class="fa fa-bolt"></i>
                                                            </span> A user IP blocked. </span>
                                                <span class="time">3 days</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-warning md-skip">
                                                                <i class="fa fa-bell-o"></i>
                                                            </span> Storage Server #4 not responding dfdfdfd. </span>
                                                <span class="time">4 days</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-info md-skip">
                                                                <i class="fa fa-bullhorn"></i>
                                                            </span> System Error. </span>
                                                <span class="time">5 days</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                        <span class="details">
                                                            <span class="label label-sm label-icon label-danger md-skip">
                                                                <i class="fa fa-bolt"></i>
                                                            </span> Storage server failed. </span>
                                                <span class="time">9 days</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- END GROUP NOTIFICATION -->
                        <!-- BEGIN GROUP INFORMATION -->
                        <div class="btn-group-red btn-group">
                            <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-plus"></i>
                            </button>
                            <ul class="dropdown-menu-v2" role="menu">
                                <li class="active">
                                    <a href="#">New Post</a>
                                </li>
                                <li>
                                    <a href="#">New Comment</a>
                                </li>
                                <li>
                                    <a href="#">Share</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">Comments
                                        <span class="badge badge-success">4</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Feedbacks
                                        <span class="badge badge-danger">2</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END GROUP INFORMATION -->
                        <!-- BEGIN USER PROFILE -->
                        <div class="btn-group-img btn-group">
                            <button type="button" class="btn btn-sm md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span>Hi, Marcus</span>
                                <img src="../assets/layouts/layout5/img/avatar1.jpg" alt=""> </button>
                            <ul class="dropdown-menu-v2" role="menu">
                                <li>
                                    <a href="page_user_profile_1.html">
                                        <i class="icon-user"></i> My Profile
                                        <span class="badge badge-danger">1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="app_calendar.html">
                                        <i class="icon-calendar"></i> My Calendar </a>
                                </li>
                                <li>
                                    <a href="app_inbox.html">
                                        <i class="icon-envelope-open"></i> My Inbox
                                        <span class="badge badge-danger"> 3 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="app_todo_2.html">
                                        <i class="icon-rocket"></i> My Tasks
                                        <span class="badge badge-success"> 7 </span>
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="page_user_lock_1.html">
                                        <i class="icon-lock"></i> Lock Screen </a>
                                </li>
                                <li>
                                    <a href="page_user_login_1.html">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END USER PROFILE -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <button type="button" class="quick-sidebar-toggler md-skip" data-toggle="collapse">
                            <span class="sr-only">Toggle Quick Sidebar</span>
                            <i class="icon-logout"></i>
                        </button>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </div>
                    <!-- END TOPBAR ACTIONS -->
                </div>
                <!-- BEGIN HEADER MENU -->
                <div class="nav-collapse collapse navbar-collapse navbar-responsive-collapse">
                    @include("common.nav")
                </div>
                <!-- END HEADER MENU -->
            </div>
            <!--/container-->
        </nav>
    </header>
    <!-- END HEADER -->
    @yield('content')
    <div class="content"></div>


    <!-- END QUICK SIDEBAR -->
    <!--[if lt IE 9]>
    <script src="{{asset('resources/assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{asset('resources/assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('resources/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{asset('resources/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/js/jquery.bpopup.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/dist/jquery.magnific-popup.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <script src="{{asset('resources/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('resources/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/pages/scripts/ui-confirmations.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('resources/assets/js/app.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('resources/assets/layouts/layout5/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <!-- App scripts -->
    @stack('scripts')
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>
