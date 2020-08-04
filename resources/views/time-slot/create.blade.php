@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ route('massage-view') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Create Massage List</h1>
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
                            <form method="post" action="{{ route('massage.store') }}">
                                <div class="form-group">
                                    @csrf
                                    <label class="label">Start time (h):</label>
                                    <input type="time" name="start"  class="form-control" value="{{ old('start') }}" placeholder="start time" required/>
                                </div>
                                <div class="form-group">
                                    <label class="label">End time (h):</label>
                                    <input type="time" name="end" value="{{ old('end') }}" class="form-control" placeholder="end time">
                                </div>
                                <div class="form-group">
                                    <label class="label">Duration (min):</label>
                                    <input type="number" name="duration" value="{{ old('duration') }}" placeholder="duration"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="label">Price  (BGN):</label>
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="price">
                                </div>
                                <div class="form-group">
                                    <label class="label">Date:</label>
                                    <input type="date" name="m_date" value="{{ old('m_date') }}" class="form-control" placeholder="date for massage">
                                </div>
                                <div class="form-group btn-wrap">
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
