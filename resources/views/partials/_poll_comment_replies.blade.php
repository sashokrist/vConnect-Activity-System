@foreach($comments as $comment)
    <div class="comment-container display-comment">
        <ul class="heading">
            <li class="user-name">
                {{ $comment->user->name }}
            </li>
            <li class="properties-comment-field">
                {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
            </li>
        </ul>
        <p class="comment">{{ $comment->body }}</p>
        <button type="button" id="reply" class="btn toggle-item">Reply</button>
        <div class="item-box">
            <form method="post" action="{{ route('poll.reply.add') }}" class="reply-comment">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="comment_body" placeholder="Your replay here..."></textarea>
                    <input type="hidden" name="poll_id" value="{{ $poll_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group btn-wrap">
                    <input type="submit" class="btn btn-warning" value="Submit" />
                </div>
            </form>
        </div>
        @include('partials._poll_comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach
