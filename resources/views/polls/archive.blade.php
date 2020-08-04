@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Polls</h1>
    </div>
    <div class="container polls-page">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <form action="{{ route('polls.store') }} " method="post">
                                @csrf
                                <input id="name" type="hidden" value=" {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}" name="user">
                                <div class="form-check">
                                    <h2>{{ $poll->name }}</h2>
                                    <input type="hidden" name="title" value="{{ $poll->name }}">
                                    <input type="hidden" name="pollid" value="{{ $poll->id }}">
                                </div>
                                <div class="form-check">
                                    <ul>
                                        @foreach($answers as $answer)
                                            <li class="answer">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="answer" value="{{ $answer->id }}"><strong>{{ $answer->name }}</strong>
                                                    <span class="checkmark"></span>
                                                    <input type="hidden" class="form-check-input" name="answerid" value="{{ $answer->id }}">
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-holder">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <div class="comments-section">
                                <ul>
                                    <li>
                                        @foreach ($pollComments->pollComments as $item)
                                            <div class="comment">
                                                <span>{{ $item->username }}</span>
                                                <p>{{ $item->comments }}</p>
                                            </div>
                                        @endforeach
                                    </li>
                                </ul>
                                <form action="{{ route('poll/comments') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="pollid" value="{{ $poll->id }}">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Add a comment:"></textarea>
                                        @if ($errors->any())
                                            <label for="comments" class="error">{{ $errors->first('comments') }}</label>
                                        @endif
                                    </div>
                                    <div class="form-group btn-wrap">
                                        <input type="submit" class="btn btn-success" value="Add Comment" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-md-3 side-tile">
                <div class="box">
                    <h6>Archive</h6>
                    @foreach($allPolls as $poll)
                        <a href="{{ route('poll-all', $poll->id )}}" class="link">{{ $poll->name }}</a>
                    @endforeach
                </div>
            </div>--}}
        </div>
@endsection
