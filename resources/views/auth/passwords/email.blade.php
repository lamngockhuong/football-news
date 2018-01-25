@extends('light-bootstrap-dashboard::layouts.auth')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="auth-card card">
            <div class="header">
                <h4 class="title">@lang('admin.auth.reset_password')</h4>
            </div>
            <div class="content">
                {{ Form::open(['route' => ['password.email']]) }}
                    <fieldset>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            {{ Form::label('email', trans('admin.auth.email')) }}
                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        {{ Form::button(trans('admin.auth.send_reset_link'), [
                            'class' => 'btn btn-lg btn-success btn-block',
                            'type' => 'submit',
                        ])}}
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
