@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Users</h1>
    </div>
    <div class="container manage users">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">
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
                                            <p class="modal-text">Are you sure you want to delete this user?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <div style="text-align: center;">
                                                <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="buttons-container">
                            <div class="btn btn-primary dropdown">
                                <span>Download</span>
                                <ul>
                                    <li>
                                        <a href="{{action('Admin\UsersController@downloadPDF')}}">PDF format</a>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportexcel" value='Excel format'>
                                        </form>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportcsv" value='CSV format'>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>&#8470;</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Groups</th>
                                    <th class="col-extra-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><img src="{{ asset('uploads/avatars/'.$user->avatar) }}" alt="" class="avatar-img" width="40px" height="40px"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>@foreach($roles as $role)
                                            @if($user->roles->pluck('id')->contains($role->id))
                                                <span>{{ $role->name  }}</span> <br>
                                            @endif
                                         @endforeach
                                    </td>
                                    <td>
                                        @foreach($groups as $group)
                                                  @if($user->groups->pluck('id')->contains($group->id))
                                                <span>{{ $group->title }}</span><br>
                                                    @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit',$user->id) }} " class="btn btn-primary">Edit</a>
                                        <a href="javascript:" data-toggle="modal" onclick="deleteData( {{ $user->id }} )"
                                           data-target="#DeleteModal" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
@endsection

