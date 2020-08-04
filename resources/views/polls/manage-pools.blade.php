@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Polls</h1>
    </div>
    <div class="container manage manage-poll">
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
                                            <p class="modal-text">Are you sure you want to delete this poll?</p>
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
                                        <a href="{{ route('pollsPDF') }}">PDF format</a>
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
                            <a href="{{ route('polls.create') }}" class="btn btn-success">Create Poll</a>
                        </div>
                        <table class="table data-table">
                            <thead>
                            <tr>
                                <th>&#8470;</th>
                                <th>Name</th>
                                <th class="col-slim">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($polls as $poll)
                                    <tr>
                                        <td>{{ $poll->id }}</td>
                                        <td>{{ $poll->name }}</td>
                                        <td>
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$poll->id}})"
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
        $(function () {
            var table = $('.data-table').DataTable({
                "order":[],
                "columns": [
                    { "orderable": false },
                    { "orderable": false },
                    { "orderable": false }
                ],
                "dom": '<"top">rt<"bottom"><"clear">',
                language: { "emptyTable": "There are no polls created yet." }
            });
        });

        function deleteData(id)
        {
            var id = id;
            var url = '{{ route('poll/delete', ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
