@extends('layouts.app')

@section('content')
    @if($posts->count() === 0)
        <div class="container news-page">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="no-results">
                                <p class="notice">There are no items found!</p>
                                <a class="btn btn-back" href="{{ route('posts.index') }}">Go Back to News</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="header">
            <a href="{{ route('posts.index') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
            <h1>Search Results</h1>
        </div>
        <div class="container news-page">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            @foreach($posts as $post )
                                <div class="border-container post-wrap">
                                    <div class="image-box">
                                        <img src="{{ asset('image/'. array_first(json_decode($post->image))) }}" alt="" id="avatar-img" width="220px" height="220px" />
                                    </div>
                                    <div class="post-properties">
                                        <h2 class="post-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                                        <ul class="post-info">
                                            <li>
                                                {{ $post->created_at->diffForHumans() }}
                                            </li>
                                            <li>
                                                <a href="{{ route('category-search', $post->category->id) }}">{{ $post->category->name }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('post-group', $post->group->id) }}">{{ $post->group->title }}</a>
                                            </li>
                                        </ul>
                                        <p class="post-content">
                                            {{ Illuminate\Support\Str::limit($post->body, 370) }}
                                        </p>
                                        <a href="{{ route('posts.show', $post) }}" class="read-more-btn">View more</a>
                                    </div>
                                </div>
                            @endforeach
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
