@extends('layouts.app')
@section('title', trans('admin.match.index.title'))
@section('content-title', trans('admin.match.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if (isset($match))
                        <div class="header">
                            <h4 class="title">@lang('admin.match.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($match, ['route' => ['matches.update', $match->id], 'method' => 'PUT']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.match.index.edit.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.match.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team1_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team1_id', trans('admin.match.index.edit.team1')) }}
                                            <select name="team1_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team1_id') == $team->id) || ($match->team1_id == $team->id) ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team1_id'))
                                                <span class="help-block">{{ $errors->first('team1_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team2_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team2_id', trans('admin.match.index.edit.team2')) }}
                                            <select name="team2_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team2_id') == $team->id) || ($match->team2_id == $team->id) ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team2_id'))
                                                <span class="help-block">{{ $errors->first('team2_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                                            {{ Form::label('start_time', trans('admin.match.index.edit.start_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('start_time', old('start_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'starttime',
                                                    'placeholder' => trans('admin.match.index.edit.start_time_placeholder')
                                                ]) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('start_time'))
                                                <span class="help-block">{{ $errors->first('start_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                                            {{ Form::label('end_time', trans('admin.match.index.edit.end_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('end_time', old('end_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'endtime',
                                                    'placeholder' => trans('admin.match.index.edit.end_time_placeholder')
                                                ]) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('end_time'))
                                                <span class="help-block">{{ $errors->first('end_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('team1_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team1_goal', trans('admin.match.index.edit.team1_goal')) }}
                                            {{ Form::number('team1_goal', old('team1_goal'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('team1_goal'))
                                                <span class="help-block">{{ $errors->first('team1_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('team2_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team2_goal', trans('admin.match.index.edit.team2_goal')) }}
                                            {{ Form::number('team2_goal', old('team2_goal'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('team2_goal'))
                                                <span class="help-block">{{ $errors->first('team2_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('league_id') ? ' has-error' : '' }}">
                                            {{ Form::label('league_id', trans('admin.match.index.edit.league')) }}
                                            <select name="league_id" class="form-control">
                                                @foreach ($leagues as $league)
                                                    <option value="{{ $league->id }}"{{ (old('league_id') == $league->id) || ($match->league_id == $league->id) ? ' selected' : '' }}>
                                                        {{ $league->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('league_id'))
                                                <span class="help-block">{{ $errors->first('league_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.match.index.edit.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.match.index.edit.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.match.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.match.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'matches.store']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.match.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.match.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team1_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team1_id', trans('admin.match.index.add.team1')) }}
                                            <select name="team1_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ old('team1_id') == $team->id ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team1_id'))
                                                <span class="help-block">{{ $errors->first('team1_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team2_id') ? ' has-error' : '' }}">
                                            {{ Form::label('team2_id', trans('admin.match.index.add.team2')) }}
                                            <select name="team2_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ old('team2_id') == $team->id ? ' selected' : '' }}>
                                                        {{ $team->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('team2_id'))
                                                <span class="help-block">{{ $errors->first('team2_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                                            {{ Form::label('start_time', trans('admin.match.index.add.start_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('start_time', old('start_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'starttime',
                                                    'placeholder' => trans('admin.match.index.add.start_time_placeholder')
                                                ]) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('start_time'))
                                                <span class="help-block">{{ $errors->first('start_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                                            {{ Form::label('end_time', trans('admin.match.index.add.end_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('end_time', old('end_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'endtime',
                                                    'placeholder' => trans('admin.match.index.add.end_time_placeholder')
                                                ]) }}
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('end_time'))
                                                <span class="help-block">{{ $errors->first('end_time') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('team1_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team1_goal', trans('admin.match.index.add.team1_goal')) }}
                                            {{ Form::number('team1_goal', old('team1_goal', 0), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('team1_goal'))
                                                <span class="help-block">{{ $errors->first('team1_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('team2_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team2_goal', trans('admin.match.index.add.team2_goal')) }}
                                            {{ Form::number('team2_goal', old('team2_goal', 0), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                            ]) }}
                                            @if ($errors->has('team2_goal'))
                                                <span class="help-block">{{ $errors->first('team2_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('league_id') ? ' has-error' : '' }}">
                                            {{ Form::label('league_id', trans('admin.match.index.add.league')) }}
                                            <select name="league_id" class="form-control">
                                                @foreach ($leagues as $league)
                                                    <option value="{{ $league->id }}"{{ old('league_id') == $league->id ? ' selected' : '' }}>
                                                        {{ $league->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('league_id'))
                                                <span class="help-block">{{ $errors->first('league_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.match.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.match.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.match.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.match.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'matches.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.match.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.match.index.table.id')</th>
                                <th>@lang('admin.match.index.table.name')</th>
                                <th>@lang('admin.match.index.table.team1')</th>
                                <th>@lang('admin.match.index.table.team2')</th>
                                <th>@lang('admin.match.index.table.start_time')</th>
                                <th>@lang('admin.match.index.table.end_time')</th>
                                <th>@lang('admin.match.index.table.team1_goal')</th>
                                <th>@lang('admin.match.index.table.team2_goal')</th>
                                <th>@lang('admin.match.index.table.league')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($matches as $match)
                                    <tr>
                                        <td>{{ $match->id }}</td>
                                        <td>{{ $match->name }}</td>
                                        <td>{{ $match->firstTeam->name }}</td>
                                        <td>{{ $match->secondTeam->name }}</td>
                                        <td>{{ $match->left_time }}</td>
                                        <td>{{ $match->end_time_custom }}</td>
                                        <td>{{ $match->team1_goal }}</td>
                                        <td>{{ $match->team2_goal }}</td>
                                        <td>{{ $match->league->name }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('matches.edit', ['id' => $match->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.match.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['matches.destroy', 'id' => $match->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.match.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.match.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" id="no-results">@lang('admin.match.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($matches) && $matches->lastPage() > 1)
                            {{ $matches->render('admin.pagination.custom') }}
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
