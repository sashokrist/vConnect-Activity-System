@extends('layouts.app')

@section('content')
    <h1>Sign Up for Event</h1>
    <div class="container event-signup">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <form method="post" action="{{ route('signup.store') }}" autocomplete="off">
                                @csrf
                                <div class="heading">
                                    <h2>{{ $signup->title }}</h2>
                                    <h5><i class="fas fa-arrow-alt-circle-right"></i>Have signed up so far: {{ $results->count() }}</h5>
                                </div>
                                <div class="signup">
                                    <div class="form-group">
                                        <input type="hidden" value="{{ $signid }}" name="signid">
                                        <span>You are logged as:</span>
                                        <input id="name" type="text" value=" {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}" name="user">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign up</button>
                                </div>
                            </form>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">user ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        <td scope="row">{{ $result->user_id }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>
                                            @if (auth()->user()->name ===  $result->name)
                                                <form action="{{ route('signup.destroy', $result ) }}" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <input type="hidden" value="{{ $result->user_id}}" name="userid">
                                                    <button class="btn btn-danger">Delete</button>
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
                    <h6>Related polls</h6>
                    @if ($polls !== null)
                        @foreach($polls as $poll)
                            <a href="{{ route('polls.index'), $poll->id }}" class="link">{{ $poll->name }}</a>
                        @endforeach
                    @else
                        <p>No related poll</p>
                    @endif

                </div>
                {{--<div class="box">
                    <h6>Archive</h6>
                    @foreach($archives as $archive)
                        <a href="{{ route('signup-all', $archive->id) }}" class="link">{{ $archive->title }}</a>
                    @endforeach
                </div>--}}
            </div>
        </div>
    </div>
@endsection
