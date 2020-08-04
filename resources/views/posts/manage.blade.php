@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage News</h1>
    </div>
    <div class="container manage manage-post">
        <div class="row">
            <div class="col-md-12">
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
                                            <p class="modal-text">Are you sure you want to delete this news?</p>
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
                            <div class="btn btn-primary dropdown" title="Download">
                                <i class="fal fa-file-download btn-icon"></i>
                                <span class="btn-text">Download</span>
                                <ul>
                                    <li>
                                        <a href="{{action('PostController@downloadPDF')}}">PDF format</a>
                                    </li>
                                    <li>
                                        <form method='post' action='{{ route('users/export') }}'>
                                            @csrf
                                            <input type="submit" name="exportexcel" value='XLSX format'>
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
                            <a href="{{ route('posts.create') }}" class="btn btn-success" title="Create News">
                                <i class="fal fa-file-plus btn-icon"></i>
                                <span class="btn-text">Create News</span>
                            </a>
                        </div>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th class="post-number">&#8470;</th>
                                    <th class="post-title">Title</th>
                                    <th class="post-body">Body</th>
                                    <th class="col-extra-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td scope="row" class="post-number">{{ $post->id }}</td>
                                        <td class="post-title">{{ Illuminate\Support\Str::limit($post->title, 60) }}</td>
                                        <td class="post-body">{{ Illuminate\Support\Str::limit($post->body, 180) }}</td>
                                        <td>
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary"><i class="fal fa-pencil-alt btn-icon"></i><span class="btn-text">Edit</span></a>
                                           {{-- <a href="{{ route('post-delete', $post) }}" class="btn btn-danger"><i class="fal fa-trash-alt btn-icon"></i><span class="btn-text">Delete</span></a>--}}
                                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$post->id}})"
                                               data-target="#DeleteModal" class="btn btn-danger"><i class="fa fa-trash btn-icon"></i><span class="btn-text">Delete</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $posts->links() }}
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
                "columns": [
                    null,
                    null,
                    null,
                    { "orderable": false }
                ],
                "dom": '<"top">rt<"bottom"lp><"clear">',
                language: { "emptyTable": "There are no news." }
            });
        });
    </script>
    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route('post-delete', ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
