<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Real Estate Management System</title>
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
    <link href="{{asset('resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('resources/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('resources/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('resources/assets/layouts/layout5/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/layouts/layout5/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('css')
    <link href="{{asset('resources/assets/global/plugins/icheck/skins/flat/_all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('resources/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body  style="background:#fff ">
<!-- BEGIN CONTAINER -->
<div id="loadFrame" class="wrapper">

    <div class="container-fluid">
        <div class="model-content">
            @if (Session::has('success_message'))
                <div class="note note-success">
                    <p>{{ Session::get('success_message') }} </p>
                </div>
            @endif
            @include("common.errors")
            @yield('content')


        </div>
    </div>
</div>
<!-- END CONTAINER -->

<!--[if lt IE 9]>
<script src="{{asset('resources/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('resources/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('resources/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources//assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources//assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('resources/assets/global/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/autosize/autosize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script src="{{asset('resources/assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('resources/assets/pages/scripts/components-form-tools.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('resources/assets/layouts/layout5/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('resources/assets/js/app.js')}}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- App scripts -->
@stack('scripts')
</body>

</html>