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
                                <input id="name" type="hidden" value=" {{{ Auth::user()->name ?? Auth::user()->email }}}" name="user">
                                <div class="form-check">
                                    @if ($polls !== null)
                                        <h2>{{ $polls->name }}</h2>
                                        <input type="hidden" name="title" value="{{ $polls->name }}">
                                        <input type="hidden" name="pollid" value="{{ $polls->id }}">
                                </div>
                                <div class="form-check">
                                    @if ($answers !== null)
                                        <ul class="options-container">
                                            @foreach($answers as $answer)
                                                    <div class="option">
                                                        <label class="form-check-label">
                                                          {{--  @foreach($ansPicture as $picture)--}}
                                                                <div class="image-box">
                                                                    <img src="{{ asset('uploads/poll/'. $answer->picture) }}" alt="" id="avatar-img"/>
                                                                </div>
                                                         {{--   @endforeach--}}
                                                            <div class="text-box">
                                                                <input type="radio" class="form-check-input" name="answer" value="{{ $answer->id }}">
                                                                <span class="option-text">{{ $answer->name }}</span>
                                                                <span class="checkmark"></span>
                                                            </div>
                                                            <input type="hidden" class="form-check-input" name="answerid" value="{{ $answer->id }}">
                                                        </label>
                                                    </div>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="btn-holder">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <div class="comments-section">
                                @include('partials._poll_comment_replies', ['comments' => $polls->comments, 'poll_id' => $polls->id])
                                <form method="post" action="{{ route('poll.comment.add') }}" class="add-comment">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment_body" placeholder="Your comment here..."></textarea>
                                        <input type="hidden" name="poll_id" value="{{ $polls->id }}" />
                                    </div>
                                    <div class="form-group btn-wrap">
                                        <input type="submit" class="btn btn-success" value="Add Comment" />
                                    </div>
                                </form>
                            </div>
                            {{--<div class="comments-section">
                                @if ($pollComments !== null)
                                    @foreach ($pollComments->pollComments as $item)
                                        <div class="comment-container">
                                            <ul class="heading">
                                                <li class="user-name">
                                                    {{ $item->username }}
                                                </li>
                                                <li class="properties-comment-field">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                                </li>
                                            </ul>
                                            <p class="comment">{{ $item->comments }}</p>
                                            <button type="button" class="btn toggle-item">Reply</button>
                                            <div class="item-box">
                                                <form method="post" action="{{ route('poll/comments') }}" class="reply-comment">
                                                    @csrf
                                                    <input type="hidden" name="pollid" value="{{ $polls->id }}">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="comments" id="comments" placeholder="Your reply here..."></textarea>
                                                        @if ($errors->any())
                                                            <label for="comments" class="error">{{ $errors->first('comments') }}</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-group btn-wrap">
                                                        <input type="submit" class="btn btn-warning" value="Submit" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <form action="{{ route('poll/comments') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="pollid" value="{{ $polls->id }}">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Your comment here..."></textarea>
                                            @if ($errors->any())
                                                <label for="comments" class="error">{{ $errors->first('comments') }}</label>
                                            @endif
                                        </div>
                                        <div class="form-group btn-wrap">
                                            <input type="submit" class="btn btn-success" value="Add Comment" />
                                        </div>
                                    </form>
                                @endif
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 side-tile">
                <div class="box">
                    <h6>Related sign-ups</h6>
                    @if ($signup !== null)
                        <a href="{{ route('poll-related', $signup->id) }}" class="link">{{ $signup->title }}</a>
                    @else
                        <p>There are no related sign-ups!</p>
                    @endif
                </div>
                {{--<div class="box">
                    <h6>Archive</h6>
                    @foreach($allPolls as $poll)
                        <a href="{{ route('poll-all', $poll->id )}}" class="link">{{ $poll->name }}</a>
                    @endforeach
                </div>--}}
            </div>
            @else
                <h2 class="no-items">There are no polls created yet!</h2>
            @endif
        </div>
    </div>
@endsection
