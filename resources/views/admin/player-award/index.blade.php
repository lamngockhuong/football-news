@extends('layouts.app')
@section('title', trans('admin.player-award.index.title'))
@section('content-title', trans('admin.player-award.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @if (isset($award))
                        <div class="header">
                            <h4 class="title">@lang('admin.player-award.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($award, ['route' => ['player-awards.update', $award->id], 'method' => 'PUT', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.player-award.index.edit.name')) }}
                                            {{ Form::hidden('id', old('id')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.player-award.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('player_id') ? ' has-error' : '' }}">
                                            {{ Form::label('player_id', trans('admin.player-award.index.add.player')) }}
                                            <select name="player_id" class="form-control">
                                                @foreach ($players as $player)
                                                    <option value="{{ $player->id }}"{{ (old('player_id') == $player->id) || ($award->player_id == $player->id) ? ' selected' : '' }}>
                                                        {{ $player->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('player_id'))
                                                <span class="help-block">{{ $errors->first('player_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                            {{ Form::label('match_id', trans('admin.player-award.index.add.match')) }}
                                            <select name="match_id" class="form-control">
                                                @foreach ($matches as $match)
                                                    <option value="{{ $match->id }}"{{ (old('match_id') == $match->id) || ($award->match_id == $match->id) ? ' selected' : '' }}>
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
                                {{ Form::button(trans('admin.player-award.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.player-award.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'player-awards.store', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.player-award.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.player-award.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('player_id') ? ' has-error' : '' }}">
                                            {{ Form::label('player_id', trans('admin.player-award.index.add.player')) }}
                                            <select name="player_id" class="form-control">
                                                @foreach ($players as $player)
                                                    <option value="{{ $player->id }}"{{ old('player_id') == $player->id ? ' selected' : '' }}>
                                                        {{ $player->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('player_id'))
                                                <span class="help-block">{{ $errors->first('player_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                            {{ Form::label('match_id', trans('admin.player-award.index.add.match')) }}
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
                                {{ Form::button(trans('admin.player-award.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.player-award.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'player-awards.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.player-award.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.player-award.index.table.id')</th>
                                <th>@lang('admin.player-award.index.table.name')</th>
                                <th>@lang('admin.player-award.index.table.player')</th>
                                <th>@lang('admin.player-award.index.table.match')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($awards as $award)
                                    <tr>
                                        <td>{{ $award->id }}</td>
                                        <td>{{ $award->name }}</td>
                                        <td>{{ $award->player->name }}</td>
                                        <td>{{ $award->match->name }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('player-awards.edit', ['id' => $award->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.player-award.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['player-awards.destroy', 'id' => $award->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.player-award.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.player-award.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" id="no-results">@lang('admin.player-award.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($awards) && $awards->lastPage() > 1)
                            {{ $awards->render('admin.pagination.custom') }}
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
