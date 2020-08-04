@extends('layouts.app')

@section('content')
<h1>Users</h1>
    <div class="container manage-users">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary float-right" href="{{ url('/admin') }}"><i class="fas fa-clipboard"></i><span>Admin</span></a><br>
                        <hr>
                        <form action="{{ route('users-search') }}" method="post" class="form-control-sm">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="users" class="form-control" placeholder="search for user...">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="https://www.algolia.com/realtime-search-demo/demo1-1f9bcf34-e7fa-46ec-9de4-ba63ec816f18" class="btn btn-primary">use Algolia UI</a>
                        </form> <br>
                        <hr>
                        <div class="border-container">
                            <form method='post' action='{{ route('users/export') }}'>
                                @csrf
                                <input type="submit" class="btn btn-success" name="exportexcel" value='Excel Export'>
                                <input type="submit" class="btn btn-success" name="exportcsv" value='CSV Export'>
                            </form>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">&#8470;</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td scope="row">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                            <td class="action-btns">
                                                @can('update-users')
                                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit<</a>
                                                @endcan
                                                @can('delete-users')
                                                    <form action="{{ route('users.destroy', $user) }}" method="post">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
