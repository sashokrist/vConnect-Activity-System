@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Sign-Up for Event</h1>
</div>
<div class="container event-signup">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="border-container">
                        @if ($signups !== null)
                        <form method="post" action="{{ route('signup.store') }}" autocomplete="off">
                            @csrf
                            <div class="heading">
                                <h2>{{ $signups->title }}</h2>
                                <h5><i class="fas fa-arrow-alt-square-right"></i>Have signed up so far:<small>{{ $results->count() }}</small></h5>
                            </div>
                            <div class="signup form-group">
                                <input type="hidden" value="{{ $signid }}" name="signid">
                                <input id="name" type="text" value="{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}," name="user">
                                <span>Do you want to sign up for this event?</span>
                                <button type="submit" class="btn btn-primary">Sign up</button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    {{--<th scope="col">user ID</th>--}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        {{--<td scope="row">{{ $result->user_id }}</td>--}}
                                        <td>{{ $result->name }}</td>
                                        <td>
                                            @if ($authUserName ==  $result->name)
                                                <form action="{{ route('signup.destroy', $result ) }}" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <input type="hidden" value="{{ $result->user_id}}" name="userid">
                                                    <button class="btn btn-danger btn-xs">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 side-tile">
            <div class="box">
                <h6>Related poll</h6>
                @if ($polls !== null)
               {{-- @foreach($polls as $poll)--}}
                   <a href="{{ route('polls.index'), $polls->id }}" class="link">{{ $polls->name }}</a>
                {{--@endforeach--}}
                @else
                    <p>There are no related poll!</p>
                @endif
            </div>
            @else
                <h2 class="no-items">There are no sign-ups created yet!</h2>
            @endif
           {{-- <div class="box">
                <h6>Archive</h6>
                @foreach($archives as $archive)
                    <a href="{{ route('signup-all', $archive->id) }}" class="link">{{ $archive->title }}</a>
                @endforeach
            </div>--}}
        </div>
    </div>
</div>
@endsection
