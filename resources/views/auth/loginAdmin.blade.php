@extends('layouts.login_layout')

@section('content')

    @include('partials.title-admin')

    <div class="login-form">
        <form method="POST" action="{{ route('login-admin') }}">
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

            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
            
            <div class="options">
                <a class="go-to" href="{{ route('login') }}"><i class="fas fa-long-arrow-alt-left"></i>{{ __('Go Back') }}</a>
            </div>
        </form>
    </div>

@endsection
