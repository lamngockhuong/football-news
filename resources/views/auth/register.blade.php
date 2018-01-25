@extends('light-bootstrap-dashboard::layouts.auth')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="auth-card card">
            <div class="header">
                <h4 class="title">@lang('admin.auth.register')</h4>
            </div>
            <div class="content">
                {{ Form::open(['route' => ['register']]) }}
                    <fieldset>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {{ Form::label('name', trans('admin.auth.name')) }}
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            {{ Form::label('email', trans('admin.auth.email')) }}
                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::label('password', trans('admin.auth.password')) }}
                            {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {{ Form::label('password_confirmation', trans('admin.auth.password_confirmation')) }}
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        {{ Form::button(trans('admin.auth.register'), [
                            'class' => 'btn btn-lg btn-success btn-block',
                            'type' => 'submit',
                        ])}}
                        <a href="{{ route('login') }}" class="btn btn-lg btn-default btn-block">@lang('admin.auth.login')</a>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
