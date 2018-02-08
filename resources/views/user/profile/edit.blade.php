@extends('layouts.app')
@section('title', trans('admin.profile.edit.title'))
@section('content-title', trans('admin.user.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">@lang('admin.profile.edit.title')</h4>
                    </div>
                    <div class="content">
                        {{ Form::model($user, ['route' => ['user.profiles.update', $user->id], 'method' => 'PUT', 'files' => true]) }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        {{ Form::label('name', trans('admin.profile.edit.name')) }}
                                        {{ Form::hidden('id', $user->id) }}
                                        {{ Form::hidden('provider', $user->provider) }}
                                        {{ Form::text('name', old('name'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin.profile.edit.name_placeholder')
                                        ]) }}
                                        @if ($errors->has('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{ Form::label('email', trans('admin.profile.edit.email')) }}
                                        {{ Form::email('email', old('email'), [
                                            'class' => 'form-control',
                                            'placeholder' => trans('admin.profile.edit.email_placeholder')
                                        ]) }}
                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} upload-image">
                                        {{ Form::label('image', trans('admin.profile.edit.avatar')) }}
                                        {{ Form::file('image', ['class' => 'form-control']) }}
                                        @if ($errors->has('image'))
                                            <span class="help-block">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div id="image-preview" data-src="{{ $user->avatar_url }}"></div>
                                    </div>
                                </div>
                            </div>
                            <span>@lang('admin.profile.edit.last_update'): {{ $user->last_update_date }}</span>
                            {{ Form::button(trans('admin.profile.edit.submit_button'), [
                                'class' => 'btn btn-info btn-fill pull-right',
                                'type' => 'submit'
                            ]) }}
                            <div class="clearfix"></div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400"
                            alt="...">
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="{{ route('user.profiles.edit', ['id' => $user->id]) }}">
                                <img class="avatar border-gray" src="{{ $user->avatar_url }}"
                                    onerror='this.src="{{ asset('images/no-image.png') }}"' alt="...">
                                <h4 class="title">{{ $user->name }}</h4>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @if (session('notification'))
            <div id="notify" data-message="{{ session('notification')['message'] }}" data-type="{{ session('notification')['type'] }}"></div>
        @endif
    </div>
@endsection
