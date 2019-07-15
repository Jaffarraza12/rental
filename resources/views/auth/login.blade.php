@extends('layouts.appAuth')

@section('content')

    <div class="login ng-scope">
            <div class="top-spacing hidden-for-small-only" style="padding-top: 140px;"></div>
            <div id="login-form" class="login-box">
                <div class="login-logo"></div>
                {{--<h4 translate="" class="ng-scope">Good morning</h4>--}}
                <form id="login-form" action="{{ URL('/login') }}" method="post" class="ng-pristine ng-valid">
                    <div class="inputbox">
                        <i class="icon-email"></i>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="Username Or Email" size="30" class="validate tooltipstered">
                    </div>
                    <div class="inputbox">
                        <i class="icon-password"></i>
                        <input type="password" id="login-password" placeholder="Password" name="password" size="30" class="validate tooltipstered">
                    </div>
                    <div class="alertbox">
                        <span id="login-alert">
                            @include('auth.notifications')
                            {{ csrf_field() }}
                        </span>
                    </div>
                    <div class="inputbox" style="background:none;">
                        <small><a href="javascript:loadRequestForm()" translate="" class="ng-scope">Forgot password?</a></small>
                    </div>
                    <div class="buttonbox">
                        <button type="submit" id="btn-login" class="btn btn-fill ng-scope success" translate="">Login</button><br>
                        <small><br><a href="#" translate="" class="ng-scope">Don't have an account? Get Started</a></small>
                    </div>
                    {{--<div class="identifierbox">
                        <button type="button" class="btn-identifier linkedin" onclick="launchIdentifier('linkedin')"></button>
                    </div>--}}
                </form>
            </div>
            <div id="reset-request" class="login-box hidden">
                <h4 translate="" class="ng-scope">Request password reset</h4>
                <form id="request-form" action="/get/login" method="post" class="ng-pristine ng-valid">
                    <div class="inputbox">
                        <input type="email" id="request-email" name="request-email" placeholder="email" size="30">
                        <i class="icon-email"></i>
                    </div>
                    <div class="alertbox">
                        <span id="reset-request-alert"></span>
                    </div>
                    <div class="inputbox" style="background:none;">
                        <small><a href="javascript:loadLoginForm()" translate="" class="ng-scope">‹ Back to login</a></small>
                    </div>
                    <div class="buttonbox">
                        <input type="hidden" name="action" id="action" value="request">
                        <button type="submit" id="btn-request" class="btn btn-fill ng-scope" translate="">Send</button><br>
                    </div>
                </form>
            </div>
            <div id="reset-password" class="login-box hidden">
                <h4 translate="" class="ng-scope">Enter new password</h4>
                <form id="reset-form" action="/get/login" method="post" class="ng-pristine ng-valid">
                    <div class="inputbox">
                        <input type="password" id="new-password" name="new-password" placeholder="new password" size="30">
                        <i class="icon-password"></i>
                    </div>
                    <div class="inputbox">
                        <input type="password" id="new-password-repeat" name="new-password-repeat" class="validate tooltipstered" placeholder="repeat new password" size="30">
                        <i class="icon-password"></i>
                    </div>
                    <div class="alertbox">
                        <span id="reset-alert"></span>
                    </div>
                    <div class="buttonbox">
                        <input type="hidden" name="action" id="action" value="reset">
                        <input type="hidden" name="reset-password-key" id="reset-password-key" value="">
                        <input type="hidden" name="user-id" id="user-id" value="">
                        <button type="submit" id="btn-reset" class="btn btn-fill ng-scope" translate="">Reset</button><br>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>


<!-- END LOGIN FORM -->
@endsection