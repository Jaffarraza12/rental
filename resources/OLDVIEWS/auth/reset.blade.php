@extends('layouts.appAuth')
@section('content')
 <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{ URL('/password/emai') }} method="post">
        {{ csrf_field() }}
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->

<!-- END LOGIN FORM -->
@endsection