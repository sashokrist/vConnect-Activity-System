@extends('resources.views.layouts.app')

@section('content')
    <h1>Categories</h1>
    <div class="container new-post category-created">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <div class="buttons-container">
                                <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Category</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-xs">Edit</a>
                                                <form action="{{ route('categories.destroy', $category) }}" method="post">
                                                    @csrf
                                                    {{ method_field('delete') }}
                                                    <button class="btn btn-danger btn-xs">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
