@extends('layouts.app')
@section('title', trans('admin.rank.index.title'))
@section('content-title', trans('admin.rank.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{--  <div class="col-md-4">
                <div class="card">
                    @if (isset($rank))
                        <div class="header">
                            <h4 class="title">@lang('admin.rank.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($rank, ['route' => ['ranks.update', $rank->id], 'method' => 'PUT']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.rank.index.edit.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.rank.index.edit.name_placeholder')
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
                                            {{ Form::label('team1_id', trans('admin.rank.index.edit.team1')) }}
                                            <select name="team1_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team1_id') == $team->id) || ($rank->team1_id == $team->id) ? ' selected' : '' }}>
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
                                            {{ Form::label('team2_id', trans('admin.rank.index.edit.team2')) }}
                                            <select name="team2_id" class="form-control">
                                                @foreach ($teams as $team)
                                                    <option value="{{ $team->id }}"{{ (old('team2_id') == $team->id) || ($rank->team2_id == $team->id) ? ' selected' : '' }}>
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
                                            {{ Form::label('start_time', trans('admin.rank.index.edit.start_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('start_time', old('start_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'starttime',
                                                    'placeholder' => trans('admin.rank.index.edit.start_time_placeholder')
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
                                            {{ Form::label('end_time', trans('admin.rank.index.edit.end_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('end_time', old('end_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'endtime',
                                                    'placeholder' => trans('admin.rank.index.edit.end_time_placeholder')
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
                                            {{ Form::label('team1_goal', trans('admin.rank.index.edit.team1_goal')) }}
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
                                            {{ Form::label('team2_goal', trans('admin.rank.index.edit.team2_goal')) }}
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
                                            {{ Form::label('league_id', trans('admin.rank.index.edit.league')) }}
                                            <select name="league_id" class="form-control">
                                                @foreach ($leagues as $league)
                                                    <option value="{{ $league->id }}"{{ (old('league_id') == $league->id) || ($rank->league_id == $league->id) ? ' selected' : '' }}>
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
                                            {{ Form::label('description', trans('admin.rank.index.edit.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.rank.index.edit.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.rank.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.rank.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'ranks.store']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.rank.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.rank.index.add.name_placeholder')
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
                                            {{ Form::label('team1_id', trans('admin.rank.index.add.team1')) }}
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
                                            {{ Form::label('team2_id', trans('admin.rank.index.add.team2')) }}
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
                                            {{ Form::label('start_time', trans('admin.rank.index.add.start_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('start_time', old('start_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'starttime',
                                                    'placeholder' => trans('admin.rank.index.add.start_time_placeholder')
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
                                            {{ Form::label('end_time', trans('admin.rank.index.add.end_time')) }}
                                            <div class="input-group">
                                                {{ Form::text('end_time', old('end_time'), [
                                                    'class' => 'form-control',
                                                    'id' => 'endtime',
                                                    'placeholder' => trans('admin.rank.index.add.end_time_placeholder')
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
                                            {{ Form::label('team1_goal', trans('admin.rank.index.add.team1_goal')) }}
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
                                            {{ Form::label('team2_goal', trans('admin.rank.index.add.team2_goal')) }}
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
                                            {{ Form::label('league_id', trans('admin.rank.index.add.league')) }}
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
                                            {{ Form::label('description', trans('admin.rank.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.rank.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.rank.index.add.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @endif
                </div>
            </div>  --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">@lang('admin.rank.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                        <select name="league" class="form-control" id="league-ranking-select">
                            <option value="">@lang('admin.rank.index.all')</option>
                            @foreach ($leagues as $rank)
                                <option value="{{ $rank->league->id }}"{{ request()->league == $rank->league->id ? ' selected' : '' }}>
                                    {{ $rank->league->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="title ranking-search">
                            {{ Form::open(['route' => ['ranks.index', 'league' => request()->league ? request()->league : '0'], 'method' => 'GET']) }}
                                {{ Form::hidden('league', request()->league ? request()->league : '0') }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'id' => 'table-search-form', 'placeholder' => trans('admin.rank.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.rank.index.table.id')</th>
                                <th>@lang('admin.rank.index.table.team')</th>
                                <th>@lang('admin.rank.index.table.league')</th>
                                <th>@lang('admin.rank.index.table.won')</th>
                                <th>@lang('admin.rank.index.table.drawn')</th>
                                <th>@lang('admin.rank.index.table.lost')</th>
                                <th>@lang('admin.rank.index.table.goals_for')</th>
                                <th>@lang('admin.rank.index.table.goals_against')</th>
                                <th>@lang('admin.rank.index.table.goal_difference')</th>
                                <th>@lang('admin.rank.index.table.score')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($ranks as $rank)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rank->team->name }}</td>
                                        <td>{{ $rank->league->name }}</td>
                                        <td>{{ $rank->won }}</td>
                                        <td>{{ $rank->drawn }}</td>
                                        <td>{{ $rank->lost }}</td>
                                        <td>{{ $rank->goals_for }}</td>
                                        <td>{{ $rank->goals_against }}</td>
                                        <td>{{ $rank->goal_difference }}</td>
                                        <td class="ranking-point" id="ranking-point-{{ $rank->id }}">
                                            <span data-id="{{ $rank->id }}">
                                                {{ $rank->score }}
                                            </span>
                                            {{ Form::text('point', $rank->score, [
                                                'class' => 'form-control',
                                                'data-url' => route('ranks.update', $rank->id)
                                            ])}}
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="javascript:void(0)"
                                                id="edit-ranking-point-{{ $rank->id }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-id="{{ $rank->id }}"
                                                data-original-title="@lang('admin.rank.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['ranks.destroy', 'id' => $rank->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.rank.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.rank.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" id="no-results">@lang('admin.rank.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($ranks) && $ranks->lastPage() > 1)
                            {{ $ranks->render('admin.pagination.custom') }}
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
