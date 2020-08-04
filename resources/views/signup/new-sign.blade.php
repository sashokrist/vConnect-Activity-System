@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Create Sign up</h1>
    </div>
    <div class="container new-post">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            <form method="post" action="{{ route('signups.store') }}" >
                                <div class="form-group">
                                    @csrf
                                    <h3>Add Sign up:</h3>
                                    <input type="text" name="title" placeholder="Enter title here" class="form-control" required/>
                                    @if ($errors->any())
                                        <label for="title" class="error">{{ $errors->first('title') }}</label>
                                    @endif
                                </div>
                                <h3>Add poll (optional):</h3>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="question"  placeholder="Enter poll question here">
                                        @if ($errors->any())
                                            <label for="question" class="error">{{ $errors->first('question') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input class="form-control"  type="text" name="answer1"  placeholder="Enter answer 1">
                                        @if ($errors->any())
                                            <label for="answer1" class="error">{{ $errors->first('answer1') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer2"  placeholder="Enter answer 2">
                                        @if ($errors->any())
                                            <label for="answer2" class="error">{{ $errors->first('answer2') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer3"  placeholder="Enter answer 3">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer4"  placeholder="Enter answer 4">
                                    </label>
                                </div>
                                <div class="form-group btn-wrap">
                                    <input type="submit" class="btn btn-success" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
