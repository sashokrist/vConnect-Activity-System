@extends('layouts.app')

@section('content')
    @if($search->count() === 0)
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
                            @foreach($search as $item)
                                <div class="border-container post-wrap">
                                    <div class="image-box">
                                        <img src="{{ asset('image/'. array_first(json_decode($item->image))) }}" alt="" id="avatar-img" width="220px" height="220px" />
                                    </div>
                                    <div class="post-properties">
                                        <h2 class="post-title"><a href="{{ route('posts.show', $item) }}">{{ $item->title }}</a></h2>
                                        <ul class="post-info">
                                            <li>
                                                {{ $item->created_at->diffForHumans() }}
                                            </li>
                                            <li>
                                                <a href="{{ route('category-search', $item->category->id) }}">{{ $item->category->name }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('post-group', $item->group->id) }}">{{ $item->group->title }}</a>
                                            </li>
                                        </ul>
                                        <p class="post-content">
                                            {{ Illuminate\Support\Str::limit($item->body, 370) }}
                                        </p>
                                        <a href="{{ route('posts.show', $item) }}" class="read-more-btn">View more</a>
                                    </div>
                                </div>
                            @endforeach
                            {{ $search->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

{{--
@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Search result</h1>
    </div>
    <div class="container manage">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <table class="table data-table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Body</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('posts-search') }}",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'body', name: 'body'},
                ],
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                language: { search: '', searchPlaceholder: "Search..." }
            });
        });
    </script>
@endsection
--}}
