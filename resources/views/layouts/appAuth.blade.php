<!DOCTYPE html>

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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="{{asset('resources/assets/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('resources/assets/css/main.css')}}">
    <script src="{{asset('resources/assets/dist/vendor.js')}}"></script>
    <!-- END PAGE LEVEL STYLES -->
     </head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
{{--<div class="logo">
    <a href="index.html">
        <img src="{{asset('resources/assets/img/Collgur-logo-white.png')}}"  width="200" height="auto" alt="" /> </a>
</div>--}}
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div ng-include="templates/login.html" class="ng-scope">
    <!-- BEGIN LOGIN FORM -->
    @yield('content')



    <!-- END REGISTRATION FORM -->
</div>
<script src="{{asset('resources/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

<script class="ng-scope">
    $( document ).ready(function() {
        loadQuerystring();
        initLoginForm();
        initControls();
        localStorage.clear();
    });

    function initControls(){
        setTimeout(function(){
            if (!$("#login-form").hasClass('hidden')){
                document.title='Login | GetAccept';
                if ($("#login-email").val() != ''){
                    $("#login-password").focus();
                }
                else{
                    $("#login-email").focus();
                }
            }
            else if (!$("#reset-request").hasClass('hidden')){
                document.title='Reset password | GetAccept';
                $("#request-email").focus();
            }
            else if (!$("#reset-password").hasClass('hidden')){
                document.title='Reset password | GetAccept';
                $("#new-password").focus();
            }
        }, 500);

        $('#login-form h4').text(getGreetingTime());
        $(window).resize( $.throttle( 300, resizeLogin ) );
        resizeLogin();
    }

    function resizeLogin(){
        var loginTopSpacing = ($(document).height()-$('.login-box:not(.hidden)').height())/2;
        $('.login .top-spacing').css('padding-top',loginTopSpacing);
    }


    function loadLoginForm(){
        $('#login-form').removeClass('hidden');
        $('#reset-request').addClass('hidden');
        $('#reset-password').addClass('hidden');
        initControls();
    }

    function loadRequestForm(){
        $('#login-form').addClass('hidden');
        $('#reset-request').removeClass('hidden');
        $('#reset-password').addClass('hidden');
        initControls();
    }

    function loadResetForm(){
        $('#login-form').addClass('hidden');
        $('#reset-request').addClass('hidden');
        $('#reset-password').removeClass('hidden');
        initControls();
    }


    function launchIdentifier(provider){
        var redirectUri = document.location.protocol+'//'+document.location.host+'/auth/'+provider+'/';
        var requestUrl = 'auth/'+provider+'/?redirect='+encodeURIComponent(redirectUri);
        var authWin = window.open(requestUrl,'authWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=590,height=580,top='+(($(window).height()/2)-290)+',left='+(($(window).width()/2)-295));
    }



</script>
</body>

</html>