@extends('layouts.login_layout')

@section('content')

    @include('partials.title')

    <div class="login-form">
        <h2>{{ __('Forgot Password?') }}</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="e-mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary">
                {{ __(' Reset Password') }}
            </button>

            <div class="options">
                <a class="go-to" href="{{ route('login') }}"><i class="fas fa-long-arrow-alt-left"></i>{{ __('Back to Login') }}</a>
            </div>
        </form>
    </div>

@endsection