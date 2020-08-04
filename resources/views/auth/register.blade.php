{{-- @extends('layouts.app') --}}
@extends('layouts.login_layout')

@section('content')

    @include('partials.title')

    <div class="login-form">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('name') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('e-mail') }}" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('password') }}" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input id="password-confirm" type="password" class="form-control" placeholder="{{ __('confirm password') }}" name="password_confirmation" required autocomplete="new-password">



            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>

            <div class="options">
                <a class="go-to" href="{{ route('login') }}"><i class="fas fa-long-arrow-alt-right"></i>{{ __('Go to Login') }}</a>
            </div>
        </form>
    </div>

@endsection