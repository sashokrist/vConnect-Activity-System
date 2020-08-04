@extends('layouts.app')

@section('content')
    <h1 class="text-center">Search Results</h1>
    <div class="container admin-page">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <a href="{{ route('users.index') }}" class="btn btn-primary float-right">Back</a>
                    <div class="card-body">

                        <div class="border-container post-wrap">
                            <div class="post-properties">
                                @if($search->count() == 0)
                                    <p>No records found</p>
                                @else
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($search as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ implode(', ', $item->roles()->get()->pluck('name')->toArray())}}</td>
                                                <td class="action-btns">
                                                    @can('update-users')
                                                        <a href="{{ route('users.edit', $item) }}"><button class="btn btn-primary">Edit</button></a>
                                                    @endcan
                                                    @can('delete-users')
                                                        <form action="{{ route('users.destroy', $item) }}" method="post">
                                                            @csrf
                                                            {{ method_field('delete') }}
                                                            <button class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

