@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ url('/groups') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Edit Group</h1>
    </div>
    <div class="container new-post">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="border-container">
                            <form method="post" action="{{ route('groups.update', $group) }}">
                                <div class="form-group">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <label class="label">Group Title:</label>
                                    <input type="text" name="title" value="{{ $group->title }}" class="form-control" placeholder="Enter group title here" required/>
                                </div>
                                <div class="form-group btn-wrap">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
