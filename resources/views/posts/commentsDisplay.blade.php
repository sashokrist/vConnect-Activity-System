@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@foreach($comments as $comment)
    <div class="comment-container" @if($comment->parent_id != null) @endif>
       {{-- <strong>{{ $comment->user->name }}</strong>--}}
        <ul class="heading">
            <li class="user-name">
               {{-- <img src="{{asset('uploads/avatars/'.$avatar)}}" alt="profile picture" width="30" height="30">--}}
                {{ $comment->username }}
            </li>
            <li class="properties-comment-field">
                {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
            </li>
        </ul>
        <p class="comment">{{ $comment->body }}</p>
        {{-- <a href="" id="reply"></a> --}}
        <button type="button" class="btn toggle-item">Reply</button>
        <div class="item-box">
            <form method="post" action="{{ route('comments.store') }}" class="reply-comment">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="body" placeholder="Your replay here..."></textarea>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group btn-wrap">
                    <input type="submit" class="btn btn-warning" value="Submit Comment" />
                </div>
            </form>
        </div>
       {{-- @include('posts.commentsDisplay', ['comments' => $comment->replies])--}}
    </div>
@endforeach
