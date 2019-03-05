<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Colligur</title>
    <style type="text/css">
        .ReadMsgBody {
            width:100%;
            background-color:#ffffff;
        }

        .ExternalClass {
            width:100%;
            background-color:#ffffff;
        }

        body {
            width:100%;
            background-color:#ffffff;
            margin:0;
            padding:0;
            -webkit-font-smoothing:antialiased;
            font-family:Verdana, Geneva, sans-serif;
        }

        table {
            border-collapse:collapse;
            border-spacing: 0px;
        }

        @media only screen and (max-width: 640px){
            .deviceWidth {
                width:440px !important;
                padding:0;
            }
            .title {
                width:149px !important;
                padding:5px 0px 5px 0px !important;
            }
            .nav_links {
                width:249px !important;
                padding:5px 0px 5px 0px !important;
            }
            .center {
                text-align:center !important;
            }
            .headline {
                font-size: 50px;
            }
        }


        @media only screen and (max-width: 479px) {
            .deviceWidth {
                width:280px !important;
                padding:0;
            }
            .spacer_td {
                height:50px !important;
            }
            .magic_td {
                position: absolute;
            }
            .img_container {
                width:280px !important;
                padding:0;
                overflow:hidden !important;
                max-width: 280px !important;
                text-align: center;
                position: relative;
                top:-30px;
            }
            .img_container img {
                position: relative;
                left: -160px;
                top: 0px;
            }
            .title {
                width:100% !important;
                text-align: center;
            }
            .nav_links_container {
                width:100% !important;
                text-align: center;
            }
            .nav_links_container td, .title td {
                padding:5px 0px 5px 0px !important;
            }
            .social_icon_container {
                font-size: 8px !important;
            }
            .nav_links {
                font-size: 8px !important;
            }
            .headline {
                font-size: 40px;
            }
            .mobile_break {
                display:block;
            }
        }
    </style>


</head>
<body marginwidth="0" style="font-family:Verdana, Geneva, sans-serif" marginheight="0" topmargin="0" leftmargin="0">
@yield('content')
<div style="display:none;white-space:nowrap;font:15px courier;color:#ffffff;">
    - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
</div>
</body>
</html>