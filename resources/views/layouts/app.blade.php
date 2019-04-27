<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Real Esatate Management System</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
    <link href="{{asset('resources/assets/layouts/gotmanaged/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/layouts/gotmanaged/css/themes/blue.css')}}" rel="stylesheet" type="text/css" id="style_color" />

    <link href="{{asset('resources/assets/layouts/gotmanaged/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('css')
    <link href="{{asset('resources/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/css/popup.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/css/form.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/css/sidebar-menu.css')}}" rel="stylesheet" type="text/css" />

   <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="icon.png" />
    <script type="text/javascript">
        function resizeIframe(obj) {
              // $("iframe")[0].style.height = $("iframe")[0].contentWindow.document.body.scrollHeight + 80 + 'px';

        }
    </script>

    </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN CONTAINER -->
<div class="wrapper">
    <!-- BEGIN HEADER -->
    <!-- END HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="{{URL('/')}}">
                    <img src="{{asset('resources/assets/img/GMlogo.png')}}" alt="Logo" width="200" height="auto" style="margin-top: 20px;">  </a>
                <div class="menu-toggler sidebar-toggler hidden-lg">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN PAGE ACTIONS -->
            <!-- DOC: Remove "hide" class to enable the page header actions -->
            <div class="page-actions" style="float: right;margin-right:20px;">
                <div class="btn-group">
                    {{--{{ \Illuminate\Support\Facades\Session::get('defaultBuilding') }}--}}
                    <select id="building" >
                        <option>Select Building</option>
                        @if(Auth::user()->pid==0)
                        @foreach( $selected_building as $b )
                            @if( $b->user_id == Auth::id() )
                                <option value="{{$b->building_id}}" @if( \Illuminate\Support\Facades\Session::get('defaultBuilding') == $b->building_id ) selected="selected" @endif >{{$b->name}}</option>
                            @endif
                            {{--<option value="{{$b->building_id}}">{{$b->name}}</option>--}}
                        @endforeach
                        @else
                            @foreach( $user_building as $b )
                                @if( $b->id == Auth::id() )
                                    <option value="{{$b->building_id}}" @if( \Illuminate\Support\Facades\Session::get('defaultBuilding') == $b->building_id ) selected="selected" @endif >{{$b->name}}</option>
                                @endif
                            @endforeach
                           @endif
                    </select>
                    <button style="display: none;" type="button" class="btn btn-circle btn-outline red dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-sm hidden-xs">Select Building&nbsp;</span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        @foreach( $selected_building as $b )
                        <li>
                            <a href="javascript:;">
                                <i class="icon-docs"></i> {{$b->name}} </a>
                        </li>
                        @endforeach
                    </ul>

                    <ul class="dropdown-menu" role="menu" style="display: none">
                        <li>
                            <a href="javascript:;">
                                <i class="icon-docs"></i> New Post </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-tag"></i> New Comment </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-share"></i> Share </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-flag"></i> Comments
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="icon-users"></i> Feedbacks
                                <span class="badge badge-danger">2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END PAGE ACTIONS -->
            <!-- BEGIN PAGE TOP -->
            <div class="page-top ">
                <!-- BEGIN HEADER SEARCH BOX -->
                <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET" style="display: none">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search..." name="query" type="text">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                    </div>
                </form>
                <!-- END HEADER SEARCH BOX -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <div class="rentalForm">
    @yield('content')
    </div>
    <div class="content"></div>


    <!-- END QUICK SIDEBAR -->
    <!--[if lt IE 9]>
    <script src="{{asset('resources/assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{asset('resources/assets/global/plugins/excanvas.min.js')}}"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('resources/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
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
    <script src="{{asset('resources/assets/css/sidebar-menu.js')}}" type="text/javascript"></script>
    <!-- App scripts -->
    <script>
        $.sidebarMenu($('.sidebar-menu'))
    </script>
    <script>

        $(document).ready(function () {
            @if( ! \Illuminate\Support\Facades\Session::get('defaultBuilding') )
app.popUp('{{URL('show-building')}}','body')
            @endif

        });
$("#building").on('change',function () {
           var id = $(this).val();
            $.get('{{URL('/building/switch/')}}/'+id, function(){
                if('response'){
                    //alert('response');
                    //console.log('response');
                    location.reload();
                }
            });
        });
    </script>


    @stack('scripts')
    <!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>
