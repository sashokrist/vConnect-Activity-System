@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Contact Us</h1>
    </div>
    <div class="container contact-us">
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>bul. Aleksander Malinov 91, Sofia, Bulgaria</p>
                        </li>            
                        <li>
                            <i class="fas fa-phone-alt mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>            
                        <li>
                            <i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>admin@vconnect.dk</p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <div class="container">
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        {!! Form::open(['route'=>'contactus.store']) !!}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Name']) !!}
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Message here...']) !!}
                            <span class="text-danger">{{ $errors->first('message') }}</span>
                        </div>
                        <div class="form-group btn-wrap">
                            <button class="btn btn-success">Send</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection