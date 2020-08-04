@extends('resources.views.layouts.app2')

@section('content')
    <h1>Manage News</h1>
    <div class="container manage manage-post">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="buttons-container">
                            <div class="btn btn-primary dropdown">
                                <span>Download</span>
                                <ul>
                                    <li>
                                        <a href="{{action('PostController@downloadPDF')}}">Download PDF</a>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportexcel" value='Download Excel'>
                                        </form>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportcsv" value='Download CSV'>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('posts.create') }}" class="btn btn-success">Create News</a>
                        </div>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>&#8470;</th>
                                    <th class="col-wide">Title</th>
                                    <th>Body</th>
                                    <th class="col-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('posts-manage') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'body', name: 'body'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                language: { search: '', searchPlaceholder: "Search..." }
            });
        });
    </script>
@endsection
