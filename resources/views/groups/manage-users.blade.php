@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage User Groups</h1>
    </div>
    <div class="container manage">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Groups</th>
                                    <th scope="col" class="col-slim">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $item)
                                    @if ($item->groups->count() > 0)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td class="groups">
                                                @foreach($item->groups as $usr)
                                                    <span class="item">{{ $usr->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{ route('groups/destroy') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-danger">Remove Group</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
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
                "columns": [
                    null,
                    null,
                    { "orderable": false },
                    { "orderable": false }
                ],
                "dom": '<"top">rt<"bottom"><"clear">',
                language: { "emptyTable": "There are no user groups." }
            });
        });
    </script>
@endsection
