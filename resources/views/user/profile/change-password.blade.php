@extends('layouts.app')
@section('title', trans('admin.profile.change-password.title'))
@section('content-title', trans('admin.user.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">@lang('admin.profile.change-password.title')</h4>
                    </div>
                    <div class="content">
                        {{ Form::open(['route' => 'user.profiles.change-password', 'method' => 'PUT']) }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                        {{ Form::label('current_password', trans('admin.profile.change-password.current_password')) }}
                                        {{ Form::password('current_password', [
                                            'class' => 'form-control',
                                        ]) }}
                                        @if ($errors->has('current_password'))
                                            <span class="help-block">{{ $errors->first('current_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{ Form::label('password', trans('admin.profile.change-password.new_password')) }}
                                        {{ Form::password('password', [
                                            'class' => 'form-control',
                                        ]) }}
                                        @if ($errors->has('password'))
                                            <span class="help-block">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        {{ Form::label('password_confirmation', trans('admin.profile.change-password.password_confirmation')) }}
                                        {{ Form::password('password_confirmation', [
                                            'class' => 'form-control',
                                        ]) }}
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{ Form::button(trans('admin.profile.change-password.submit_button'), [
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
                            <a href="{{ route('user.profiles.edit', ['id' => auth()->user()->id]) }}">
                                <img class="avatar border-gray" src="{{ auth()->user()->avatar_url }}"
                                    onerror='this.src="{{ asset('images/no-image.png') }}"' alt="...">
                                <h4 class="title">{{ auth()->user()->name }}</h4>
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
