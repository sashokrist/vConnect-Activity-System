@extends('layouts.app2')

@section('content')
    <div class="header">
        <h1>Manage Sign-Ups</h1>
    </div>
    <div class="container manage">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-body">
                        <div class="buttons-container">
                            <div class="btn btn-primary dropdown">
                                <span>Download</span>
                                <ul>
                                    <li>
                                        <a href="{{ route('signupsPDF') }}">PDF format</a>
                                    </li>
                                </ul>
                            </div>
                            <a class="btn btn-success" href="{{ route('new-signup') }}">Create Sign-Up</a>
                        </div>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>&#8470;</th>
                                    <th>Title</th>
                                    <th style="width: 150px;">Action</th>
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
    <div class="modal fade multi-field" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog create-item">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="modalHeading"></span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="signup_id" id="signup_id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter sign-up title" value="" maxlength="50" required="">
                        </div>
                        <h2 class="toggle-item">
                            <span>Add related poll</span>
                            <span id="icon"><i class="fas fa-plus-square"></i></span>
                        </h2>
                        <div class="related-poll item-box">
                            <div class="form-group">
                                <input type="text" class="form-control" id="poll" name="poll" placeholder="Enter poll title" value="" maxlength="50">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="answer1" name="answer1" placeholder="Enter poll answer" value="" maxlength="50">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="answer2" name="answer2" placeholder="Enter poll answer" value="" maxlength="50">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="answer3" name="answer3" placeholder="Enter poll answer" value="" maxlength="50">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="answer4" name="answer4" placeholder="Enter poll answer" value="" maxlength="50" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxDeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Confirmation</span>
                    <button type="button" class="closeBtn close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Are you sure you want to delete this sign-up?</p>
                </div>
                <div class="modal-footer">
                    <div style="text-align: center;">
                        <button type="button" class="btn cancel" id="cancelBtn">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" id="deleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('signups.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                "language": {
                    search: "",
                    searchPlaceholder: "Search...",
                    "emptyTable": "There are no sign-ups."
                }
            });

           /* $('#createNewProduct').click(function () {
                $('#saveBtn').val("create-signup");
                $('#saveBtn').html("Create");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modalHeading').html("Create New Sign-Up");
                $('#ajaxModal').modal('show');
            });*/

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ route('signups.index') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modalHeading').html("Edit Sign-Up");
                    $('#saveBtn').val("edit-user");
                    $('#saveBtn').html("Save");
                    $('#ajaxModal').modal('show');
                    $('#product_id').val(data.id);
                    $('#name').val(data.title);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('signups.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                        $('#productForm').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            });

            var productDelete;
            var confirmDeleteModal;

            $('body').on('click', '.deleteProduct', function () {
                var product_id = $(this).data("id");
                productDelete = $(this).data("id");
                confirmDeleteModal = $('#ajaxDeleteModal');
                confirmDeleteModal.modal('show');
            });

            $('#deleteBtn').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('signups.store') }}"+'/'+productDelete,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
                confirmDeleteModal.modal('hide');
            });

            $('#cancelBtn').on('click', function () {
                confirmDeleteModal.modal('hide');
            });

        });
    </script>
@endsection
