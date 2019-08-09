@extends('layouts.auth')

@section('title', 'Login')
@section('description', 'Login')
@section('body:class', 'hold-transition login-page')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('index') }}"><b>Demen</b> Book</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback help-block" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="invalid-feedback help-block" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
                </div>
            </div>

        </form>

        <hr>

        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
        <br>
        <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register a new account') }}</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
