@extends('layouts.login_layout')

@section('content')

    @include('partials.title')

    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="username" name="email" value="{{ old('email') }}" required autocomplete="email"
                autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="password" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label class="remember-checkbox" for="remember">
                <input type="checkbox" checked="checked" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <span>{{ __('Remember Me') }}</span>
            </label>

            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>

            <p class="admin-login">
                <a class="go-to" href="{{ route('admin-login') }}"><i class="fas fa-long-arrow-alt-right"></i>Login as administrator</a>
            </p>
            <div class="options">
                <a class="go-to" href="{{ route('register') }}">{{ __('Register') }}</a>
                @if (Route::has('password.request'))
                    <a class="forgot-pass" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>

        </form>
    </div>

@endsection
