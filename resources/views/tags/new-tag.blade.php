@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ url('/tags') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Create Tag</h1>
    </div>
    <div class="container new-poll">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <form action="{{ route('tags.store') }} " method="post">
                                @csrf
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Enter tag name here" required>
                                        @if ($errors->any())
                                            <label for="name" class="error">{{ $errors->first('name') }}</label>
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
