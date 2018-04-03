@extends('layouts.app')
@section('title', trans('admin.event.index.title'))
@section('content-title', trans('admin.event.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{ Form::model($event, ['route' => ['match-events.update', $event->id], 'files' => true, 'method' => 'PUT']) }}
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">@lang('admin.event.edit.title')</h4>
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        {{ Form::label('title', trans('admin.event.edit.name')) }}
                                        {{ Form::text('title', old('title'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin.event.edit.name_placeholder')
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
                                        {{ Form::label('description', trans('admin.event.edit.description')) }}
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
                                        {{ Form::label('content', trans('admin.event.edit.content')) }}
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
                        <div class="header pull-left">
                            <span>@lang('admin.event.edit.last_update_date') {{ $event->last_update_date }}</span>
                        </div>
                        <div class="header pull-right">
                            {{ Form::button(trans('admin.event.edit.submit_button'), [
                                'class' => 'btn btn-info btn-fill pull-right',
                                'type' => 'submit'
                            ]) }}
                        </div>
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                        {{ Form::label('match_id', trans('admin.event.edit.match')) }}
                                        <select name="match_id" class="form-control">
                                            @foreach ($matches as $match)
                                                <option value="{{ $match->id }}"{{ old('match_id') == $match->id || $event->match->id == $match->id ? ' selected' : '' }}>
                                                    {{ $match->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('match_id'))
                                            <span class="help-block">{{ $errors->first('match_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} upload-image">
                                        {{ Form::label('image', trans('admin.event.edit.image')) }}
                                        {{ Form::file('image', [
                                            'class' => 'form-control',
                                            'accept' => 'image/png, image/jpeg, image/gif',
                                        ]) }}
                                        @if ($errors->has('image'))
                                            <span class="help-block">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div id="image-preview" data-src="{{ $event->image_url }}"></div>
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
