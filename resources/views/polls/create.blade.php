{{--<html lang="en">
<head>
    <title>Create New Poll</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3 class="jumbotron">Create New Poll</h3>
    <form method="post" action="{{ route('polls.newpoll') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-group control-group img_div form-group col-md-4" >
           Question: <input  type="text" class="form-control" name="question"  placeholder="Enter poll question here">
            <hr>
            Answer: <input type="text" name="answers[]" class="form-control" placeholder="enter answer"/>
            <input type="file" name="profileImage[]" class="form-control">
            <!-- Add More Button -->
            <div class="input-group-btn">
                <button class="btn btn-success btn-add-more" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
            </div>
            <!-- End -->
        </div>
        <!-- Add More Image upload field  -->
        <div class="clone hide ">
            <div class="control-group input-group form-group col-md-4" style="margin-top:10px">
                Answer: <input type="text" name="answers[]" class="form-control" placeholder="enter answer" />
                <input type="file" name="profileImage[]" class="form-control">
                <div class="input-group-btn">
                    <button class="btn btn-danger btn-remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
        </div>
        <!-- End -->


        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-top:10px">Save</button>
            </div>
        </div>

    </form>
</div>
</body>
</html>
<script type="text/javascript">

    $(document).ready(function() {

        $(".btn-add-more").click(function(){
            var html = $(".clone").html();
            $(".img_div").after(html);
        });

        $("body").on("click",".btn-remove",function(){
            $(this).parents(".control-group").remove();
        });

    });

</script>--}}
{{--
@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ route('polls-manage') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Create Poll</h1>
    </div>
    <div class="container new-poll">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    --}}{{--

--}}
{{--@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif--}}{{--
--}}
{{--

                    <div class="card-body">
                        <div class="border-container">
                            <form action="{{ route('polls.newpoll') }} " method="post" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                            --}}{{--

--}}
{{-- <input type="hidden" name="pollid" value="{{ $id }}">--}}{{--
--}}
{{--

                                <h3>Add poll question:</h3>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="question"  placeholder="Enter poll question here">
                                        @if ($errors->any())
                                            <label for="question" class="error">{{ $errors->first('question') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <h3>Add poll answers:</h3>
                                <div  id="dynamicInputs">
                                    <div class="form-group">
                                        <label>
                                            <input class="form-control"  type="text" name="answer1"  placeholder="Enter answer 1">
                                            <input type="file" name="pic1">
                                            --}}{{--

--}}
{{-- @if ($errors->any())
                                                <label for="answer1" class="error">{{ $errors->first('answer1') }}</label>
                                            @endif --}}{{--
--}}
{{--

                                        </label>
                                    </div>
                                    --}}{{--

--}}
{{-- NB! By default there it is one input. User can now add more input options dynamically. --}}{{--
--}}
{{--

                                </div>
                                --}}{{--

--}}
{{-- <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer2"  placeholder="Enter answer 2">
                                        <input type="file" name="pic2">
                                        @if ($errors->any())
                                            <label for="answer2" class="error">{{ $errors->first('answer2') }}</label>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer3"  placeholder="Enter answer 3">
                                        <input type="file" name="pic3">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer4"  placeholder="Enter answer 4">
                                        <input type="file" name="pic4">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer5"  placeholder="Enter answer 5">
                                        <input type="file" name="pic5">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer6"  placeholder="Enter answer 6">
                                        <input type="file" name="pic6">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer7"  placeholder="Enter answer 7">
                                        <input type="file" name="pic7">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer8"  placeholder="Enter answer 8">
                                        <input type="file" name="pic8">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer9"  placeholder="Enter answer 9">
                                        <input type="file" name="pic9">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input  type="text" class="form-control" name="answer10"  placeholder="Enter answer 10">
                                        <input type="file" name="pic10">
                                    </label>
                                </div> --}}{{--
--}}
{{--

                                <input type="button" value="Add another text input" id="addInput">
                                <div class="form-control btn-wrap">
                                    <button type="submit" class="btn btn-success form-control">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
--}}{{--

@extends('layouts.app')
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
@section('content')

<body>
<div class="container">
    <br />
    <h3 align="center">Create New Poll</h3>
    <br />
    <div class="table-responsive">
        <form method="post" id="dynamic_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <span id="result"></span>
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                <tr>
                    <th>Question: <input type="text" name="question" class="form-control" /></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2" align="right">&nbsp;</td>
                    <td>
                        @csrf
                        <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>
</body>
@endsection

<script>
    $(document).ready(function(){

        var count = 1;
        dynamic_field(count);
        function dynamic_field(number)
        {
            html = '<tr>';
            /*html += '<td><input type="text" name="first_name[]" class="form-control" /></td>';*/
            html += '<td>Answer: <input type="text" name="answer[]" class="form-control" /><input type="file" id="fileupload" name="photos[]" data-url="/upload" multiple=""></td>';

            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                $('tbody').append(html);
            }
            else
            {
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add answer</button></td></tr>';
                $('tbody').html(html);
            }
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
        });

        $('#save').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
               data: $('#dynamic_form').serialize(),
                url: "{{ route('polls.newpoll') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#dynamic_form').trigger("reset");

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#save').html('Save Changes');
                }
            });
        });

    });
</script>
--}}


@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>Create Poll</h1>
    </div>
    <div class="container create-poll lst">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('polls.newpoll') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="dynamic input-group increment" >
                                <div class="form-group">
                                    <input type="text" name="question" class="myfrm form-control" placeholder="Enter question...">
                                </div>
                                <div class="form-group option-container">
                                    <input type="text" name="answers[]" class="form-control"  placeholder="Enter answer...">
                                    <div class="upload-wrap">
                                        <input type="file" name="filenames[]" id="image" class="dataInputField myfrm inputimage"/>
                                        <label for="image" class="forupload">
                                            <strong><i class="far fa-image"></i></strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="input-group-btn add-option">
                                    <button id="addInput" class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i> Add option</button>
                                </div>
                            </div>
                            <div id="dynamicInputs">
                                {{-- content comes from JS --}}
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.remove', function(){
                count--;
                $(this).closest("tr").remove();
            });
        });
    </script>
@endsection
