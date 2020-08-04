@extends('layouts.app')

@section('content')
<div class="container home-page">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <h1>Welcome to vConnect Activity System.</h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 box">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                  <div class="flip-card-front">
                                    <i class="fal fa-newspaper"></i>
                                    <h3>News</h3>
                                  </div>
                                  <div class="flip-card-back">
                                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View more</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 box">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                  <div class="flip-card-front">
                                    <i class="fal fa-poll"></i>
                                    <h3>Polls</h3>
                                  </div>
                                  <div class="flip-card-back">
                                    <a href="{{ route('polls.index') }}" class="btn btn-primary">View more</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 box">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                  <div class="flip-card-front">
                                    <i class="fal fa-spa"></i>
                                    <h3>Massage</h3>
                                  </div>
                                  <div class="flip-card-back">
                                    <a href="{{ route('massage') }}" class="btn btn-primary">View more</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 box">
                            <div class="flip-card">
                                <div class="flip-card-inner">
                                  <div class="flip-card-front">
                                    <i class="fal fa-user-plus"></i>
                                    <h3>Sign Up</h3>
                                  </div>
                                  <div class="flip-card-back">
                                    <a href="{{ route('signup.index') }}" class="btn btn-primary">View more</a>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
