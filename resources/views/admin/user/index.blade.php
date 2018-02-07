@extends('layouts.app')
@section('title', trans('admin.user.index.title'))
@section('content-title', trans('admin.user.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if (isset($user))
                        <div class="header">
                            <h4 class="title">@lang('admin.user.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.user.index.edit.name')) }}
                                            {{ Form::hidden('id', $user->id) }}
                                            {{ Form::hidden('provider', $user->provider) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.user.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {{ Form::label('coin', trans('admin.user.index.edit.coin')) }}
                                            {{ Form::number('coin', old('email'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('coin'))
                                                <span class="help-block">{{ $errors->first('coin') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            {{ Form::label('email', trans('admin.user.index.edit.email')) }}
                                            {{ Form::email('email', old('email'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.user.index.edit.email_placeholder')
                                            ]) }}
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if (!$user->provider)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                {{ Form::label('password', trans('admin.user.index.edit.password')) }}
                                                {{ Form::password('password', [
                                                    'class' => 'form-control',
                                                ]) }}
                                                @if ($errors->has('password'))
                                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} upload-image">
                                            {{ Form::label('image', trans('admin.user.index.edit.avatar')) }}
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('is_actived') ? ' has-error' : '' }}">
                                            {{ Form::label('is_actived', trans('admin.user.index.edit.status')) }}
                                            <select name="is_actived" class="form-control">
                                                <option value="0" {{ old('is_actived') == config('setting.users.non_actived') || $user->is_actived != config('setting.users.non_actived') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.edit.status_nonactive')
                                                </option>
                                                <option value="1" {{ old('is_actived') == config('setting.users.actived') || $user->is_actived == config('setting.users.actived') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.edit.status_active')
                                                </option>
                                            </select>
                                            @if ($errors->has('is_actived'))
                                                <span class="help-block">{{ $errors->first('is_actived') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                                            {{ Form::label('is_admin', trans('admin.user.index.edit.level')) }}
                                            <select name="is_admin" class="form-control">
                                                <option value="0" {{ old('is_admin') == config('setting.users.is_member') || $user->is_admin != config('setting.users.is_member') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.edit.level_member')
                                                </option>
                                                <option value="1" {{ old('is_admin') == config('setting.users.is_admin') | $user->is_admin == config('setting.users.is_admin') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.edit.level_admin')
                                                </option>
                                            </select>
                                            @if ($errors->has('is_actived'))
                                                <span class="help-block">{{ $errors->first('is_actived') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.user.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.user.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'users.store', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.user.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.user.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {{ Form::label('coin', trans('admin.user.index.add.coin')) }}
                                            {{ Form::number('coin', old('coin', 0), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('coin'))
                                                <span class="help-block">{{ $errors->first('coin') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            {{ Form::label('email', trans('admin.user.index.add.email')) }}
                                            {{ Form::email('email', old('email'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.user.index.add.email_placeholder')
                                            ]) }}
                                            @if ($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            {{ Form::label('password', trans('admin.user.index.add.password')) }}
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
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} upload-image">
                                            {{ Form::label('image', trans('admin.user.index.add.avatar')) }}
                                            {{ Form::file('image', ['class' => 'form-control']) }}
                                            @if ($errors->has('image'))
                                                <span class="help-block">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div id="image-preview"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('is_actived') ? ' has-error' : '' }}">
                                            {{ Form::label('is_actived', trans('admin.user.index.add.status')) }}
                                            <select name="is_actived" class="form-control">
                                                <option value="0" {{ old('is_actived') == config('setting.users.non_actived') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.add.status_nonactive')
                                                </option>
                                                <option value="1" {{ old('is_actived') == config('setting.users.actived') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.add.status_active')
                                                </option>
                                            </select>
                                            @if ($errors->has('is_actived'))
                                                <span class="help-block">{{ $errors->first('is_actived') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('is_admin') ? ' has-error' : '' }}">
                                            {{ Form::label('is_admin', trans('admin.user.index.add.level')) }}
                                            <select name="is_admin" class="form-control">
                                                <option value="0" {{ old('is_admin') == config('setting.users.is_member') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.add.level_member')
                                                </option>
                                                <option value="1" {{ old('is_admin') == config('setting.users.is_admin') ? ' selected' : '' }}>
                                                    @lang('admin.user.index.add.level_admin')
                                                </option>
                                            </select>
                                            @if ($errors->has('is_actived'))
                                                <span class="help-block">{{ $errors->first('is_actived') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.user.index.add.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">
                            <a href="{{ route('users.index') }}">
                                @lang('admin.user.index.table.title')
                            </a>
                        </h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'users.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.user.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.user.index.table.id')</th>
                                <th>@lang('admin.user.index.table.name')</th>
                                <th>@lang('admin.user.index.table.email')</th>
                                <th>@lang('admin.user.index.table.coin')</th>
                                <th>@lang('admin.user.index.table.status')</th>
                                <th>@lang('admin.user.index.table.level')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            {{ $user->provider ? trans('admin.user.index.table.social_user') : $user->email }}
                                            {{ $user->provider && $user->email ? "($user->email)" : '' }}
                                        </td>
                                        <td>{{ $user->coin }}</td>
                                        <td>
                                            <a href="{{ route('users.index', ['status' => $user->is_actived]) }}">
                                                {{ $user->is_actived ? trans('admin.user.index.table.active') : trans('admin.user.index.table.non_active') }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.index', ['level' => $user->is_admin]) }}">
                                                {{ $user->is_admin ? trans('admin.user.index.table.admin') : trans('admin.user.index.table.member') }}
                                            </a>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('users.edit', ['id' => $user->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.user.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @if ($user->id != auth()->user()->id)
                                                {!! Form::open(['route' => ['users.destroy', 'id' => $user->id]]) !!}
                                                    {{ method_field('DELETE') }}
                                                    {!! Form::button('<i class="fa fa-times"></i> ',
                                                        [
                                                            'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                            'type' => 'submit',
                                                            'rel' => 'tooltip',
                                                            'data-original-title' => trans('admin.user.index.table.remove_button_title'),
                                                            'data-delete-confirm' => trans('admin.user.index.table.message.delete_confirm'),
                                                        ])
                                                    !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" id="no-results">@lang('admin.user.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($users) && $users->lastPage() > 1)
                            {{ $users->render('admin.pagination.custom') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (session('notification'))
            <div id="notify" data-message="{{ session('notification')['message'] }}" data-type="{{ session('notification')['type'] }}"></div>
        @endif
    </div>
@endsection
