@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ url('/groups') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Create Group</h1>
    </div>
    <div class="container new-poll">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <form action="{{ route('groups.store') }} " method="post">
                                @csrf
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="title"  placeholder="Enter group title here" required>
                                        @if ($errors->any())
                                            <label for="title" class="error">{{ $errors->first('title') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-control btn-wrap">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
