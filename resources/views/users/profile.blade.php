<script>
    // "global" variable
    var currentAvatarImg = '{{ asset('uploads/avatars/'.$user->avatar) }}';
</script>

@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Profile Settings</h1>
    </div>
    <div class="container profile">
        <div id="DeleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form action="" id="deleteForm" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span>Confirmation</span>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <p class="modal-text">Are you sure you want to delete your account?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="avatar">
                            <img src="{{ asset('uploads/avatars/'.$user->avatar) }}" alt="" id="avatar-img" width="100px" height="100px">
                            <form class="upload-avatar-img" method="POST" action="{{ route('user/profile') }}" enctype="multipart/form-data">
                                @csrf
                                <label for="avatar" id="choose-file">
                                    <i class="fas fa-camera"></i>
                                    <span>Choose file</span>
                                    <input id="avatar" type="file" name="avatar">
                                </label>
                                <div id="buttons">
                                    <button type="submit" id="upload-btn"><i class="fas fa-check"></i></button>
                                    <button type="reset" id="cancel-btn"><i class="fas fa-times"></i></button>

                                </div>
                            </form>
                        </div>
                        <span class="user-name">{{ $user->name }}</span>
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$user->id}})" data-target="#DeleteModal" class="delete-user btn" title="Delete Profile">
                           <i class="fa fa-trash"></i>
                        </a>
                        <form action="{{ route('users.update', $user) }}" method="post" class="profile-settings form-control">
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
                            <button type="submit" class="save btn">Save Changes</button>
                        </form>
                        <button class="more-settings toggle-item">
                            <h2>Manage Subscriptions</h2>
                            <span id="icon-arrows"><i class="fas fa-angle-double-down"></i></span>
                        </button>
                        <div class="subscriptions item-box">
                            <table class="table">
                                <thead>
                                </thead>
                                <tbody>
                                    @foreach($userSub->subscribe as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <form action="{{ route('user/profile-unsubscribe') }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <button type="submit" class="btn" title="DELETE SUBSCRIPTION"><i class="fas fa-times"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h3>Subscribe for:</h3>
                            <form action="{{ route('user/subscribe') }}" method="post" class="form-control add-subscr">
                                @csrf
                                <div class="wrap">
                                    @foreach($subscribesAll as $subscribe)
                                    <div class="box">
                                        <label class="form-check-label">
                                            <input type="checkbox" value="{{ $subscribe->id }}"  name="subscribe[]" class="form-check-input"
                                            @if($user->subscribe->pluck('id')->contains($subscribe->id)) checked @endif>
                                            <span class="checkmark"></span>
                                            <span>{{ $subscribe->title }}</span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="titles" value="{{ $subscribe->title }}">
                                        <input type="hidden" name="user" value="{{ $user }}">
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = '{{ route('users.destroy', ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>
