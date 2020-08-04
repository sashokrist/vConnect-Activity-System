@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Groups</h1>
    </div>
    <div class="container manage">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                            <p class="modal-text">Are you sure you want to delete this group?</p>
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
                            <a href="{{ route('groups.create') }}" class="btn btn-success">Create Group</a>
                        </div>
                        <table class="table data-table">
                            <thead>
                            <tr>
                                <th>&#8470;</th>
                                <th>Title</th>
                                <th class="col-slim">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->title }}</td>
                                    <td>
                                        <a href="javascript:" data-toggle="modal" onclick="deleteData( {{ $group->id }} )"
                                            data-target="#DeleteModal" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
            var url = '{{ route('groups.destroy', ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
