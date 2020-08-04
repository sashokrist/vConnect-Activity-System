@extends('resources.views.layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Categories</h1>
    </div>
    <div class="container manage">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="buttons-container">
                            <div class="btn btn-primary dropdown">
                                <span>Download</span>
                                <ul>
                                    <li>
                                        <a href="{{ route('categoriesPDF') }}">PDF</a>
                                        <span class="format">format</span>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportexcel" value='Excel'>
                                        </form>
                                        <span class="format">format</span>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportcsv" value='CSV'>
                                        </form>
                                        <span class="format">format</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
                        </div>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>&#8470;</th>
                                    <th>Title</th>
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
                ajax: "{{ route('category2') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                language: {
                    search: '', searchPlaceholder: "Search...",
                    "emptyTable": "There are no categories."
                }
            });
        });
    </script>
@endsection
