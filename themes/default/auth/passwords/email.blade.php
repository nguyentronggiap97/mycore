@extends('layouts.auth')

@section('title', 'Password email')
@section('description', 'Password email')
@section('body:class', 'hold-transition register-page')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ route('index') }}"><b>Demen</b> Book</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="invalid-feedback help-block" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ __('Send reset link') }}
                    </button>
                </div>
            </div>
        </form>

        <hr>

        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Back to login page') }}</a>
    </div>
</div>

@endsection
