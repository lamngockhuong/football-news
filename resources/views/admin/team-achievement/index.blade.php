@extends('layouts.app')
@section('title', trans('admin.team-achievement.index.title'))
@section('content-title', trans('admin.team-achievement.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @if (isset($achievement))
                        <div class="header">
                            <h4 class="title">@lang('admin.team-achievement.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($achievement, ['route' => ['team-achievements.update', $achievement->id], 'method' => 'PUT', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.team-achievement.index.edit.name')) }}
                                            {{ Form::hidden('id', old('id')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.team-achievement.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team_id', trans('admin.team-achievement.index.add.team')) }}
                                            <select name="team_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team_id') == $team->id) || ($achievement->team_id == $team->id) ? ' selected' : '' }}>
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
                                        <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                            {{ Form::label('match_id', trans('admin.team-achievement.index.add.match')) }}
                                            <select name="match_id" class="form-control">
                                                @foreach ($matches as $match)
                                                    <option value="{{ $match->id }}"{{ (old('match_id') == $match->id) || ($achievement->match_id == $match->id) ? ' selected' : '' }}>
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
                                {{ Form::button(trans('admin.team-achievement.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.team-achievement.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'team-achievements.store', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.team-achievement.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.team-achievement.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team_id', trans('admin.team-achievement.index.add.team')) }}
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
                                        <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                            {{ Form::label('match_id', trans('admin.team-achievement.index.add.match')) }}
                                            <select name="match_id" class="form-control">
                                                @foreach ($matches as $match)
                                                    <option value="{{ $match->id }}"{{ old('match_id') == $match->id ? ' selected' : '' }}>
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
                                {{ Form::button(trans('admin.team-achievement.index.add.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">@lang('admin.team-achievement.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'team-achievements.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.team-achievement.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.team-achievement.index.table.id')</th>
                                <th>@lang('admin.team-achievement.index.table.name')</th>
                                <th>@lang('admin.team-achievement.index.table.team')</th>
                                <th>@lang('admin.team-achievement.index.table.match')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($achievements as $achievement)
                                    <tr>
                                        <td>{{ $achievement->id }}</td>
                                        <td>{{ $achievement->name }}</td>
                                        <td>{{ $achievement->team->name }}</td>
                                        <td>{{ $achievement->match->name }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('team-achievements.edit', ['id' => $achievement->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.team-achievement.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['team-achievements.destroy', 'id' => $achievement->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.team-achievement.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.team-achievement.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" id="no-results">@lang('admin.team-achievement.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($achievements) && $achievements->lastPage() > 1)
                            {{ $achievements->render('admin.pagination.custom') }}
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
