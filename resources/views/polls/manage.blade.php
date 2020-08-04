@extends('layouts.app')

@section('content')
<h1>Polls Manage</h1>
<div class="container manage-poll">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="border-container">
                        <a class="btn btn-primary float-right" href="{{ url('/admin') }}"><i class="fas fa-clipboard"></i><span>Admin</span></a>
                        <div class=""> <a href="{{ route('polls.create') }}" class="btn btn-primary">New Poll</a></div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Poll Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($polls as $poll)
                                    <tr>
                                        <td scope="row">{{ $poll->id }}</td>
                                        <td>{{ $poll->name }}</td>
                                        <td>
                                            <form action="{{ route('poll/delete', $poll->id) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger">Delete</button>
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

