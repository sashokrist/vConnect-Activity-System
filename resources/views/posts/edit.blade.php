@extends('layouts.app')

@section('content')
    <div class="header">
        <a href="{{ route('posts-manage') }}" class="btn-back"><i class="fas fa-arrow-alt-square-left"></i></a>
        <h1>Edit News</h1>
    </div>
    <div class="new-post">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                <div  class="container">
                    <div class="row justify-content-center">
                        <div class="left-tile col-md-7">
                            <div class="form-group">
                                @csrf
                                {{ method_field('PUT') }}
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}{{ $post->title }}" placeholder="title..." required/>
                                @if ($errors->any())
                                    <label for="title" class="error">{{ $errors->first('title') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea name="body" rows="10" cols="30" class="form-control" placeholder="content..." required>{{ old('body') }}{{ $post->body }}</textarea>
                                @if ($errors->any())
                                    <label for="body" class="error">{{ $errors->first('body') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="right-tile col-md-5">
                            <div class="form-group">
                                {!! Form::select('tag[]', $tags, old('tag') ?: $article->tag->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag' ]) !!}
                                <p class="help-block"></p>
                                @if($errors->has('tag'))
                                    <p class="help-block">
                                        {{ $errors->first('tag') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group upload-wrap">
                                <input type="file" name="image[]" id="image" class="inputfile" value="{{ $post->image }}" data-multiple-caption="{count} files selected" multiple />
                                <label for="image" class="forupload">
                                    <strong>Choose images</strong>
                                    <span class="file-choosen"></span>
                                </label>
                                <button type="button" class="clear">×</button>
                            </div>
                            <div class="form-group upload-wrap">
                                <input type="file" name="fileAdmin[]" id="upload" class="inputfile" value="{{ $post->filename }}" data-multiple-caption="{count} files selected" multiple />
                                <label for="upload" class="forupload">
                                    <strong>Choose files</strong>
                                    <span class="file-choosen"></span>
                                </label>
                                <button type="button" class="clear">×</button>
                            </div>
                           {{-- <div class="custom-select-wrapper form-group">
                                <div class="custom-select">
                                    <div class="custom-select__trigger"><span>Select Group</span>
                                        <div class="arrow"></div>
                                    </div>
                                    <div class="custom-options">
                                        @foreach($groups as $group)
                                            <span class="custom-option" value="{{ $group->id }}" {{ ( $group->id === $post->group_id) ? 'selected' : '' }}>{{ $group->title }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="custom-select-wrapper form-group">
                                <div class="custom-select">
                                    <div class="custom-select__trigger"><span>Select Category</span>
                                        <div class="arrow"></div>
                                    </div>
                                    <div class="custom-options">
                                        @foreach($category as $cat)
                                            <span class="custom-option" value="{{ $cat->id }}" {{ ( $cat->id === $post->category_id) ? 'selected' : '' }}>{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>--}}
                            <div class="custom-select-wrapper form-group">
                                <label>
                                    <select name="groups">
                                        <option>Select group</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ ( $group->id === $post->group_id) ? 'selected' : '' }}>{{ $group->title }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                {{-- <span class="custom-option" value="{{ $group->id }}">{{ $group->title }}</span>--}}

                            </div>
                            <div class="custom-select-wrapper form-group">
                                <select name="category">
                                    <option>Select category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}" {{ ( $cat->id === $post->category_id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        {{-- <span class="custom-option" value="{{ $cat->id }}">{{ $cat->name }}</span>--}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group btn-wrap">
                                <input type="submit" class="btn btn-success" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
