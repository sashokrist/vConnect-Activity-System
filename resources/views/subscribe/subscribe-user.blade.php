@extends('layouts.login_layout')

@section('content')

    <div class="login-form subscribe">
        <h1>Stay up to date!</h1>
        <h3><i class="fas fa-angle-double-right"></i> Select the topic you want to get notified for</h3>
        <form action="{{ route('user/subscribe') }}" method="post" class="form-control">
            @csrf

            @foreach($subscribes as $subscribe)
                <label class="form-check-label">
                    <input type="checkbox" value="{{ $subscribe->id }}"  name="subscribe[]" class="form-check-input"
                           @if($user->subscribe->pluck('id')->contains($subscribe->id)) checked @endif>
                    <span class="checkmark"></span>
                    <span>{{ $subscribe->title }}</span>
                </label>
                <input type="hidden" name="sub_id[]" value="{{ $subscribe->id }}">
                <input type="hidden" name="titles[]" value="{{ $subscribe->totle }}">
            @endforeach

            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>

@endsection
