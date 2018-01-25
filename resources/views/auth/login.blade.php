@extends('light-bootstrap-dashboard::layouts.auth')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="auth-card card">
            <div class="header">
                <h4 class="title">@lang('admin.auth.login')</h4>
            </div>
            <div class="content">
                {{ Form::open(['route' => ['login']]) }}
                    <fieldset>
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
                        <div class="form-group">
                            <div>
                                <label class="checkbox">
                                    <input type="checkbox" data-toggle="checkbox"> @lang('admin.auth.remember')
                                </label>
                            </div>
                        </div>
                        {{ Form::button(trans('admin.auth.login'), [
                            'class' => 'btn btn-lg btn-success btn-block',
                            'type' => 'submit',
                        ])}}
                        <a href="{{ route('register') }}" class="btn btn-lg btn-default btn-block">@lang('admin.auth.register')</a>
                        <div class="text-right">
                            <a href="{{ route('password.request') }}" class="text-muted">@lang('admin.auth.forgot_password')</a>
                        </div>
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
