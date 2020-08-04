@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Vconnect News</h1>
    </div>
    <div class="container news-page">
        <div class="card">
            <div class="row">
                <div class="col-md-10 posts-section">
                    <form action="{{ route('posts-search') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" name="search"  placeholder="Type a search phrase">
                        </div>
                        <button type="submit" class="btn search">Search</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @foreach($posts as $post)
                        <?php /*var_dump(array_first(json_decode($post->image))); */?>
                        <div class="post-wrap">
                            <div class="image-box">
                                @if ($post->image)
                                    <img src="{{ asset('image/'. array_first(json_decode($post->image))) }}" alt="" id="avatar-img" width="220px" height="220px" />
                                    @else
                                    <img src="{{ asset('image/image.jpg') }}" alt="" id="avatar-img" width="220px" height="220px" />
                                @endif

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
                                    {{ Illuminate\Support\Str::limit($post->body, 340) }}
                                </p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="read-more-btn btn-success">View more</a>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
                <div class="col-md-2 filters-section">
                    <div class="filters">
                        <div class="filter-box">
                            <h5>Categories ({{ $categories->count() }})</h5>
                            <ul class="list-group">
                                @foreach($categories as $category)
                                    <li class="list-group-item" value="{{ $category->id }}">
                                        <i class="fas fa-caret-right"></i><a href="{{ route('category-search', $category->id) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter-box">
                            <h5>Groups ({{ $groups->count() }})</h5>
                                <ul class="list-group">
                                    @foreach($groups as $group)
                                        <li class="list-group-item" value="{{ $group->id }}">
                                            <i class="fas fa-caret-right"></i><a href="{{ route('post-group', $group->id) }}">{{ $group->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                        </div>
                        <div class="filter-box">
                            <h5>Tag Cloud ({{ $tags->count() }})</h5>
                            <div class="tagcloud">
                                @foreach($tags as $tag)
                                    <a class="tag" href="{{ route('post-tag-search', $tag->id) }}">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
