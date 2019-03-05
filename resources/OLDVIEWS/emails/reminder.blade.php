@extends('emails.layout')
@section('content')
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#2f373e" >
        <tr>
            <td width="100%" valign="top" bgcolor="" style="padding-top:20px;">
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                    <tr>
                        <td align="center">
                            <span style="color: #989898; font-size:10px;">Contact Buissness Manager for clearing the payment <a style="color: #989898;" href="https://www.colligur.ca">colligur.ca </a> </span>
                            <br/>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" align="center" class="title">
                                <tr>
                                    <td class="center" style="padding:20px 20px 20px 0px;">
                                        <a id="index" class="page-logo" href="{{URL('/')}}">
                                            <img src="{{asset('resources/assets/img/Collgur-logo-white.png')}}" alt="Colligur" width="220" height="auto">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="300" width="100%" bgcolor="#f3f3f3"  style="vertical-align: top;" valign="top">
                            <!--[if gte mso 9]>
                            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:300px;">
                                <v:fill type="tile" src="http://www.emailonacid.com/images/emails/candyshop/main-image-fade.jpg" color="#515151" />
                                <v:textbox inset="0,0,0,0">
                            <![endif]-->
                            <table border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" width="400" style="margin: 0 auto;" >
                                <tr>
                                    <td style="text-align: center;" class="center" height="50">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" class="center">
                                        <a class="headline" href="https://www.emailonacid.com" style="margin-bottom:5px;text-decoration: none; font-size: 32px;color: #49196f;font-family: Verdana, Geneva, sans-serif;">Payment Notification  <br/> </a>
                                        <a class="headline" href="https://www.emailonacid.com" style="margin-bottom:5px;text-decoration: none; font-size: 22px;color: #49196f;font-family: Verdana, Geneva, sans-serif;">Payment For #{{$lease->UNIT}} of building {{$lease->BUILDING}}</a>
                                        <a class="headline" href="https://www.emailonacid.com" style="margin-bottom:5px;text-decoration: none; font-size: 22px;color: #49196f;font-family: Verdana, Geneva, sans-serif;"> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" class="center" >
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;color: #000000;font-size:14px;" class="center">
                                        @foreach($payments as $payment)
                                            <p>{{  'Payment Due for '.$payment->payment_type.' on '.$payment->due_date}}</p>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                            <!--[if gte mso 9]>
                            </v:textbox>
                            </v:rect>
                            <![endif]-->
                        </td>
                    </tr>
                </table>
                <table width="600" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" style="margin:0 auto;">
                    <tr>
                        <td height="20" class="spacer_td">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="41" class="magic_td">
                            <div style="overflow:hidden;" class="img_container">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="20" class="spacer_td">&nbsp;</td>
                    </tr>
                </table>
                <div style="margin:0 auto;background-color:#ffffff;line-height:17px;font-size:10px;color:#9E9E9E;text-align:center;vertical-align:center;">
                    <br/>
                    Colligur<br/>
                    12345 W Email Ave., Denver, CO 80123<br/>
                    Questions or concerns? Contact us at <a href="mailto:email@yourwebsite.com" style="text-decoration:underline;color:#9E9E9E;">info@colligur.com</a>.<br/>
                    <br/>
                   <a style="display: none;" href="https://www.example.com/unsubscribe" style="text-decoration:underline;color:#9E9E9E;">Unsubscribe</a> (you can sign up again at any time)<br/>
                    <br/>
                </div>
                <div style="height:35px;margin:0 auto;background-color:#ffffff;">
                    &nbsp;
                </div><!-- spacer -->
            </td>
        </tr>
    </table>
@endsection