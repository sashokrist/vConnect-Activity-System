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
            <form method="post" action="{{ route('reply.add') }}" class="reply-comment">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="comment_body" placeholder="Your replay here..."></textarea>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group btn-wrap">
                    <input type="submit" class="btn btn-warning" value="Submit Comment" />
                </div>
            </form>
        </div>
        @include('partials._comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach
