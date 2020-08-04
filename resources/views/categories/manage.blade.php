@extends('resources.views.layouts.app')

@section('content')
    <div class="header">
        <h1>Manage Categories</h1>
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
                                            <p class="modal-text">Are you sure you want to delete this category?</p>
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
                            <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th class="col-extra-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td class="action-btns">
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary">Edit</a>
                                            <a href="javascript:" data-toggle="modal" onclick="deleteData( {{ $category->id }} )"
                                                data-target="#DeleteModal" class="btn btn-xs btn-danger">Delete</a>
                                            {{-- <form action="{{ route('categories.destroy', $category) }}" method="post">
                                                @csrf
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger">Delete</button>
                                            </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
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
        var url = '{{ route('category-delete', ":id") }}';
        url = url.replace(':id', id);
        $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#deleteForm").submit();
    }
</script>


