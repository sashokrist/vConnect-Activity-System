@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Massages</h1>
    </div>
    <div class="container manage">
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
                                            <p class="modal-text">Are you sure you want to delete this massage?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn cancel" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Delete</button>
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
                                        <a href="{{ route('categoriesPDF') }}">PDF format</a>
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
                            <a href="{{ route('massage.create') }}" class="btn btn-success">Create Massage</a>
                        </div>
                        <table class="table data-table Massages">
                            <thead>
                                <tr>
                                    <th>&#8470;</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th class="col-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($massages as $massage)
                                    <tr>
                                        <td>{{ $massage->id }}</td>
                                        <td>{{ $massage->start }}</td>
                                        <td>{{ $massage->end }}</td>
                                        <td>{{ $massage->duration }}</td>
                                        <td>{{ $massage->price }}</td>
                                        <td>
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$massage->id}})"
                                            data-target="#DeleteModal" class="btn btn-xs btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $massages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--<script type="text/javascript">
        $(function () {
            var table = $('.Massages').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('manage-massage') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'start', name: 'start'},
                    {data: 'end', name: 'end'},
                    {data: 'duration', name: 'duration'},
                    {data: 'price', name: 'price'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                language: {
                    search: '', searchPlaceholder: "Search...",
                    "emptyTable": "There are no massages."
                }
            });
        });
    </script>--}}
    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                "order":[],
                "columns": [
                    { "orderable": false }
                ],
                "dom": '<"top">rt<"bottom"><"clear">',
                language: { "emptyTable": "There are no massages created yet." }
            });
        });

        function deleteData(id)
        {
            var id = id;
            var url = '{{ route('massage.destroy', ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
