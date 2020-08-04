<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollComment;
use Illuminate\Http\Request;

class PollCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $comment = new PollComment();
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $poll = Poll::find($request->get('poll_id'));
        $poll->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new PollComment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $poll = Poll::find($request->get('poll_id'));

        $poll->comments()->save($reply);

        return back();

    }
}
