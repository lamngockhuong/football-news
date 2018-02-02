@extends('layouts.app')
@section('title', trans('admin.player.index.title'))
@section('content-title', trans('admin.player.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if (isset($player))
                        <div class="header">
                            <h4 class="title">@lang('admin.player.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($player, ['route' => ['players.update', $player->id], 'method' => 'PUT', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.player.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.player.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                            {{ Form::label('birthday', trans('admin.player.index.add.birthday')) }}
                                            {{ Form::number('birthday', old('birthday'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'placeholder' => trans('admin.player.index.add.birthday_placeholder')
                                            ]) }}
                                            @if ($errors->has('birthday'))
                                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team_id', trans('admin.player.index.add.team')) }}
                                            <select name="team_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team_id') == $team->id) || ($player->team_id == $team->id) ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team_id'))
                                                <span class="help-block">{{ $errors->first('team_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('position_id') ? ' has-error' : '' }}">
                                            {{ Form::label('position_id', trans('admin.player.index.add.position')) }}
                                            <select name="position_id" class="form-control">
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"{{ (old('position_id') == $position->id) || ($player->position_id == $position->id) ? ' selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('position_id'))
                                                <span class="help-block">{{ $errors->first('position_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                            {{ Form::label('country_id', trans('admin.player.index.add.country')) }}
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"{{ (old('country_id') == $country->id) || ($player->country_id == $country->id) ? ' selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select> @if ($errors->has('country_id'))
                                            <span class="help-block">{{ $errors->first('country_id') }}</span> @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                            {{ Form::label('image', trans('admin.player.index.add.avatar')) }}
                                            {{ Form::file('image', ['class' => 'form-control']) }}
                                            @if ($errors->has('image'))
                                                <span class="help-block">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ $player->avatar_url }}" target="_blank">
                                                <img src="{{ $player->avatar_url }}" width="250" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.player.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.player.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.player.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.player.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'players.store', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.player.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.player.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                            {{ Form::label('birthday', trans('admin.player.index.add.birthday')) }}
                                            {{ Form::number('birthday', old('birthday'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'placeholder' => trans('admin.player.index.add.birthday_placeholder')
                                            ]) }}
                                            @if ($errors->has('birthday'))
                                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team_id', trans('admin.player.index.add.team')) }}
                                            <select name="team_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ old('team_id') == $team->id ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team_id'))
                                                <span class="help-block">{{ $errors->first('team_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('position_id') ? ' has-error' : '' }}">
                                            {{ Form::label('position_id', trans('admin.player.index.add.position')) }}
                                            <select name="position_id" class="form-control">
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"{{ old('position_id') == $position->id ? ' selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('position_id'))
                                                <span class="help-block">{{ $errors->first('position_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                            {{ Form::label('country_id', trans('admin.player.index.add.country')) }}
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"{{ old('country_id') == $country->id ? ' selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select> @if ($errors->has('country_id'))
                                            <span class="help-block">{{ $errors->first('country_id') }}</span> @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                            {{ Form::label('image', trans('admin.player.index.add.avatar')) }}
                                            {{ Form::file('image', ['class' => 'form-control']) }}
                                            @if ($errors->has('image'))
                                                <span class="help-block">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.player.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.player.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.player.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.player.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'players.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.player.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.player.index.table.id')</th>
                                <th>@lang('admin.player.index.table.name')</th>
                                <th>@lang('admin.player.index.table.birthday')</th>
                                <th>@lang('admin.player.index.table.position')</th>
                                <th>@lang('admin.player.index.table.team')</th>
                                <th>@lang('admin.player.index.table.country')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($players as $player)
                                    <tr>
                                        <td>{{ $player->id }}</td>
                                        <td>{{ $player->name }}</td>
                                        <td>{{ $player->birthday }}</td>
                                        <td>{{ $player->position->name }}</td>
                                        <td>{{ $player->team->name }}</td>
                                        <td>{{ $player->country->name }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('players.edit', ['id' => $player->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.player.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['players.destroy', 'id' => $player->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.player.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.player.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" id="no-results">@lang('admin.player.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($players) && $players->lastPage() > 1)
                            {{ $players->render('admin.pagination.custom') }}
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
