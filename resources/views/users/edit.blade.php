@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ route('manage-users') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Edit User Info</h1>
    </div>
    <div class="container edit-users">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="border-container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-8 form-wrap">
                                    <form action="{{ route('users.update', $user) }}" method="post" class="form-control">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email:</label>
                                            <div class="input-wrap">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Name:</label>
                                            <div class="input-wrap">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required >
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @csrf
                                        {{ method_field('put') }}
                                        <span class="more-settings toggle-item">
                                            <h2>More Settings</h2>
                                            <span id="icon-arrows"><i class="fas fa-angle-double-down"></i></span>
                                        </span>
                                        <div class="item-box">
                                            <div class="form-check-wrap">
                                                <h3>Add role:</h3>
                                                <div class="wrap">
                                                    @foreach($roles as $role)
                                                    <div class="form-check box">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}"
                                                                @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                            <span class="checkmark"></span>
                                                            <span>{{ $role->name }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                            <div class="form-check-wrap">
                                                <h3>Add Group:</h3>
                                                <div class="wrap">
                                                    @foreach($groups as $group)
                                                        <div class="form-check box">
                                                            <label class="form-check-label checkbox-wrap">
                                                                <input type="checkbox" class="form-check-input" name="groups[]" value="{{ $group->id }}"
                                                                    {{--@if($user->id === $userId) checked @endif>--}}
                                                                @if($user->groups->pluck('id')->contains($group->id)) checked @endif>
                                                                <span class="checkmark"></span>
                                                                <span>{{ $group->title }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="save btn">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
