@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ route('posts-manage') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Create News</h1>
    </div>
    <div class="new-post">
        <div class="card">
            <div>
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    <div  class="container">
                        <div class="row justify-content-center">
                            <div class="left-tile col-md-7">
                                <div class="form-group">
                                    @csrf
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Enter title here" required/>
                                    @if ($errors->any())
                                        <label for="title" class="error">{{ $errors->first('title') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <textarea name="body" rows="10" cols="30" class="form-control" placeholder="Enter content here" required>{{ old('body') }}</textarea>
                                    @if ($errors->any())
                                        <label for="body" class="error">{{ $errors->first('body') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="right-tile col-md-5">
                                <div class="form-group">
                                    {!! Form::select('tag[]', $tags, old('tag'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag' ]) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('tag'))
                                        <p class="help-block">
                                            {{ $errors->first('tag') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group upload-wrap">
                                    <input type="file" name="image[]" id="image" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                                    <label for="image" class="forupload">
                                        <strong>Choose images</strong>
                                        <span class="file-choosen"></span>
                                    </label>
                                    <button type="button" class="clear">×</button>
                                </div>
                                <div class="form-group upload-wrap">
                                    <input type="file" name="fileAdmin[]" id="upload" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                                    <label for="upload" class="forupload">
                                        <strong>Choose files</strong>
                                        <span class="file-choosen"></span>
                                    </label>
                                    <button type="button" class="clear">×</button>
                                </div>
                                <div class="custom-select-wrapper form-group">
                                    <select name="groups">
                                        <option value="1">Select group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="custom-select-wrapper form-group">
                                    <select name="category">
                                        <option value="1">Select category</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group btn-wrap">
                                    <input type="submit" class="btn btn-success"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


{{-- @section('styles')
    @parent

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@stop

@section('javascript')
    @parent

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $("#selectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","selected");
            $("#selectall-tag").trigger("change");
        });
        $("#deselectbtn-tag").click(function(){
            $("#selectall-tag > option").prop("selected","");
            $("#selectall-tag").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@stop --}}
