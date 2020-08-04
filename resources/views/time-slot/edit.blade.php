@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Edit Massage List</h1>
    </div>
    <div class="container massage">
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
                            <form method="post" action="{{ route('massage.update', $massages->id) }}">
                                <div class="form-group">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    <label class="label">Start time:</label>
                                    <input type="time" name="start" value="{{ $massages->start }}" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label class="label">End time:</label>
                                    <input type="time" name="end" value="{{ $massages->end }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="label">Duration:</label>
                                    <input type="number" name="duration" value="{{ $massages->duration }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="label">Price:</label>
                                    <input type="text" name="price" value="{{ $massages->price }}" class="form-control">
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
