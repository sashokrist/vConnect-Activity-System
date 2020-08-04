@extends('layouts.app')

@section('content')
<h1>Vconnect Activities</h1>
    <div class="container manage-posts">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <a href="{{action('PostController@downloadPDF')}}" class="btn btn-primary">Download PDF</a><a href="{{ route('posts.pd') }}"></a>
                            <div class="btn-wrap">
                                <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
                                <a class="btn btn-primary" href="{{ url('/admin') }}"><i class="fas fa-clipboard"></i><span>Admin</span></a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <th scope="row">{{ $post->id }}</th>
                                            <td>
                                                <a href="{{ route('posts.show', $post) }}"><h4 class="post-title">{{ $post->title }}</h4></a>{{$post->body}}
                                            </td>
                                            <td class="action-btns">
                                                @can('update-posts')
                                                    <a href="{{ route('posts.edit', $post->id) }}">
                                                        <button class="btn btn-primary">Edit</button>
                                                    </a>
                                                @endcan
                                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
