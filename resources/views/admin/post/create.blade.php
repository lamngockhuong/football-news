@extends('layouts.app')
@section('title', trans('admin.post.index.title'))
@section('content-title', trans('admin.post.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{ Form::open(['route' => 'posts.store', 'files' => true]) }}
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">@lang('admin.post.add.title')</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        {{ Form::label('title', trans('admin.post.add.name')) }}
                                        {{ Form::text('title', old('title'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin.post.add.name_placeholder')
                                        ]) }}
                                        @if ($errors->has('title'))
                                            <span class="help-block">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        {{ Form::label('description', trans('admin.post.add.description')) }}
                                        {{ Form::textarea('description', old('description'), [
                                            'class' => 'form-control',
                                            'rows' => 5
                                        ]) }}
                                        @if ($errors->has('description'))
                                            <span class="help-block">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        {{ Form::label('content', trans('admin.post.add.content')) }}
                                        {{ Form::textarea('content', old('content'), ['class' => 'form-control']) }}
                                        @if ($errors->has('content'))
                                            <span class="help-block">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header pull-right">
                            {{ Form::button(trans('admin.post.add.submit_button'), [
                                'class' => 'btn btn-info btn-fill pull-right',
                                'type' => 'submit'
                            ]) }}
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                        {{ Form::label('category_id', trans('admin.post.add.category')) }}
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? ' selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="help-block">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} upload-image">
                                        {{ Form::label('image', trans('admin.post.add.image')) }}
                                        {{ Form::file('image', [
                                            'class' => 'form-control',
                                            'accept' => 'image/png, image/jpeg, image/gif',
                                        ]) }}
                                        @if ($errors->has('image'))
                                            <span class="help-block">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div id="image-preview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        @if (session('notification'))
            <div id="notify" data-message="{{ session('notification')['message'] }}" data-type="{{ session('notification')['type'] }}"></div>
        @endif
    </div>
@endsection
