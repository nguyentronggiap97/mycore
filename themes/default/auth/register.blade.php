@extends('layouts.auth')

@section('title', 'Register')
@section('description', 'Register')
@section('body:class', 'hold-transition register-page')

@section('content')

<div class="register-box">
    <div class="register-logo">
        <a href="{{ route('index') }}"><b>Demen</b> Book</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new account</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}" required autofocus />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="invalid-feedback help-block" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback help-block" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="invalid-feedback help-block" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm password') }}" required />
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                </div>
            </div>
        </form>

        <hr>

        <a class="btn btn-link" href="{{ route('login') }}">{{ __('I already have a account') }}</a>
    </div>
</div>
@endsection
