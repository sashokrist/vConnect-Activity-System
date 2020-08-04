@extends('layouts.app')

@section('content')
<a href="{{ route('posts.index') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
    <div class="container">
        <div class="container current-post">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="post-wrap">
                            <div class="post">
                                <div class="tags">
                                    @foreach ($post->tag as $tag)
                                        <a class="tag" href="{{ route('post-tag-search', $tag->id) }}"><small>{{ $tag->name }}</small></a>
                                    @endforeach
                                </div>
                                <h1 class="title">{{ $post->title }}</h1>
                                <div class="properties-container">
                                    <ul class="properties">
                                        <li class="properties-comment-field">
                                            <span>Posted:</span>{{ $post->created_at->diffForHumans() }}
                                        </li>
                                        <li>
                                            <span>By:</span>Admin
                                        </li>
                                        <li>
                                            <span>Group:</span>
                                            <a href="{{ route('post-group', $post->group->id) }}">{{ $post->group->title }}</a>
                                        </li>
                                        <li>
                                            <span>Category:</span>
                                            <a href="{{ route('category-search', $post->category->id) }}">{{ $post->category->name }}</a>
                                        </li>
                                        <li>
                                            <span>Attachments:</span>
                                            @if ($attachment !== null)
                                                @foreach($attachment as $key=>$attach)
                                                    <a class="attachment" data-href="{{ url('files/'.$attach) }}" href="#">
                                                        {{ $attach }}
                                                    </a>
                                                @endforeach
                                            @endif
                                        </li>
                                    </ul>
                                    <div id="thumbs" class="image-box">
                                        @if ($images !== null)
                                            @foreach($images as $key=>$image)
                                                <a href="#" class="thumbnail">
                                                    <img src="{{ asset('image/'.$image) }}" alt=""  class="thumbnail-image" width="163px" />
                                                </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="text-content">
                                    <p>{{ $post->body }}</p>
                                </div>
                            </div>
                            <div class="comments-section">
                                {{--<h2>Comments:</h2>
                                @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

                                <form method="post" action="{{ route('comments.store'   ) }}" class="add-comment">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" placeholder="Your comment here..."></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    </div>
                                    <div class="form-group btn-wrap">
                                        <input type="submit" class="btn btn-success" value="Submit Comment" />
                                    </div>
                                </form>--}}
                                <h2>Comments:</h2>
                                @include('partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                                <form method="post" action="{{ route('comment.add') }}" class="add-comment">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment_body" placeholder="Your comment here..."></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    </div>
                                    <div class="form-group btn-wrap">
                                        <input type="submit" class="btn btn-success" value="Submit Comment" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myDocModal">
        <div class="DocModal-content">
            <div id="myCarousel2" class="carousel slide">
                <div class="carousel-inner myDocModal-carousel-inner">
                    {{-- content loads from JS --}}
                </div>
                <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                   <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="DocModal-options">
                <a id="downloadFileBtn" href="" title="Download File" download>
                    <span><i class="fas fa-download"></i></span>
                </a>
            </div>
            <span class="DocModal-close"><i class="fas fa-times"></i></span>
        </div>
    </div>
    <div class="myImgModal">
        <div class="modal-wrapper">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner myImgModal-carousel-inner">
                    {{-- content loads from JS --}}
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                   <span class="glyphicon glyphicon-chevron-left"></span>
                   <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                   <span class="glyphicon glyphicon-chevron-right"></span>
                   <span class="sr-only">Next</span>
                </a>
            </div>
            <span class="modal-close"><i class="fas fa-times"></i></span>
        </div>
    </div>
@endsection
