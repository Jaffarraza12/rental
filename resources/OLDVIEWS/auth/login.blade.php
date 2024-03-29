@extends('layouts.appAuth')

@section('content')



<form class="login-form" action="{{ URL('/login') }}" method="post">
    <h3 class="form-title font-green">Sign In</h3>
    @include('auth.notifications')
    {{ csrf_field() }}

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username OR Email</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="email" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="Username Or Email"/> </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Login</button>
        <label class="rememberme check mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="remember" value="1" />Remember
            <span></span>
        </label>
        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
    </div>
    <div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
            </li>
            <li>
                <a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
            </li>
        </ul>
    </div>
    <div class="create-account">
        <p>
            <a href="{{URL('register')}}" id="register-btn" class="uppercase">Create an account</a>
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->
@endsection