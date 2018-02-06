@extends('layouts.app')
@section('title', trans('admin.bet.index.title'))
@section('content-title', trans('admin.bet.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if (isset($bet))
                        <div class="header">
                            <h4 class="title">@lang('admin.bet.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($bet, ['route' => ['user.bets.update', $bet->id], 'method' => 'PUT']) }}
                                <div class="row place-bet-match">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                            <div class="help-block hidden">@lang('admin.bet.index.edit.match')</div>
                                            {{ Form::label('match_id', trans('admin.bet.index.edit.match')) }}
                                            <select name="match_id" class="form-control" id="match_id">
                                                <option selected
                                                    value="{{ $bet->match->id }}"
                                                    data-team1="{{ $bet->match->firstTeam->name }}"
                                                    data-team2="{{ $bet->match->secondTeam->name }}"
                                                    data-start-time="{{ $bet->match->count_down_date }}">
                                                    {{ $bet->match->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 place-bet hidden">
                                        <div class="form-group">
                                            <label>@lang('admin.bet.index.edit.time_left')</label>
                                            <input class="form-control countdown" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row place-bet hidden">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team1_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team1_goal', trans('admin.bet.index.edit.goal')) }}
                                            <input class="form-control"
                                                min="0" name="team1_goal"
                                                type="number"
                                                value="{{ old('team1_goal', $bet->team1_goal) }}"
                                                id="team1_goal">
                                            @if ($errors->has('team1_goal'))
                                                <span class="help-block">{{ $errors->first('team1_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('team2_goal') ? ' has-error' : '' }}">
                                            {{ Form::label('team2_goal', trans('admin.bet.index.edit.goal')) }}
                                            <input class="form-control"
                                                min="0" name="team2_goal"
                                                type="number"
                                                value="{{ old('team2_goal', $bet->team2_goal) }}"
                                                id="team2_goal">
                                            @if ($errors->has('team2_goal'))
                                                <span class="help-block">{{ $errors->first('team2_goal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row place-bet hidden">
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('coin') ? ' has-error' : '' }}">
                                            {{ Form::label('coin', trans('admin.bet.index.edit.coin')) }}
                                            <input list="coins" name="coin" class="form-control" value="{{ old('coin', $bet->coin) }}">
                                            <datalist id="coins">
                                                @foreach (config('setting.bet.coins') as $coin)
                                                    <option value="{{ $coin }}">
                                                @endforeach
                                            </datalist>
                                            @if ($errors->has('coin'))
                                                <span class="help-block">{{ $errors->first('coin') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.bet.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.bet.index.add.title')</h4>
                        </div>
                        <div class="content">
                            @if (count($matches))
                                {{ Form::open(['route' => 'user.bets.store']) }}
                                    <div class="row place-bet-match">
                                        <div class="col-md-12">
                                            <div class="form-group{{ $errors->has('match_id') ? ' has-error' : '' }}">
                                                {{ Form::label('match_id', trans('admin.bet.index.add.match')) }}
                                                <select name="match_id" class="form-control" id="match_id">
                                                    <option value="0">
                                                        @lang('admin.bet.index.add.choose_the_match')
                                                    </option>
                                                    @foreach ($matches as $match)
                                                        <option{{ old('match_id') == $match->id ? ' selected' : '' }}
                                                            value="{{ $match->id }}"
                                                            data-team1="{{ $match->firstTeam->name }}"
                                                            data-team2="{{ $match->secondTeam->name }}"
                                                            data-start-time="{{ $match->count_down_date }}">
                                                            {{ $match->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('match_id'))
                                                    <span class="help-block">{{ $errors->first('match_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 place-bet hidden">
                                            <div class="form-group">
                                                <label>@lang('admin.bet.index.add.time_left')</label>
                                                <input class="form-control countdown" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row place-bet hidden">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('team1_goal') ? ' has-error' : '' }}">
                                                {{ Form::label('team1_goal', trans('admin.bet.index.add.goal')) }}
                                                <input class="form-control"
                                                    min="0" name="team1_goal"
                                                    type="number"
                                                    value="{{ old('team1_goal', 0) }}"
                                                    id="team1_goal">
                                                @if ($errors->has('team1_goal'))
                                                    <span class="help-block">{{ $errors->first('team1_goal') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('team2_goal') ? ' has-error' : '' }}">
                                                {{ Form::label('team2_goal', trans('admin.bet.index.add.goal')) }}
                                                <input class="form-control"
                                                    min="0" name="team2_goal"
                                                    type="number"
                                                    value="{{ old('team2_goal', 0) }}"
                                                    id="team2_goal">
                                                @if ($errors->has('team2_goal'))
                                                    <span class="help-block">{{ $errors->first('team2_goal') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row place-bet hidden">
                                        <div class="col-md-5">
                                            <div class="form-group{{ $errors->has('coin') ? ' has-error' : '' }}">
                                                {{ Form::label('coin', trans('admin.bet.index.add.coin')) }}
                                                <input list="coins" name="coin" class="form-control" value="{{ old('coin') }}">
                                                <datalist id="coins">
                                                    @foreach (config('setting.bet.coins') as $coin)
                                                        <option value="{{ $coin }}">
                                                    @endforeach
                                                </datalist>
                                                @if ($errors->has('coin'))
                                                    <span class="help-block">{{ $errors->first('coin') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::button(trans('admin.bet.index.add.submit_button'), [
                                        'class' => 'btn btn-info btn-fill pull-right place-bet hidden',
                                        'type' => 'submit'
                                    ]) }}
                                    <div class="clearfix"></div>
                                {{ Form::close() }}
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>@lang('admin.bet.index.add.message.no_matches_upcomming')</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">@lang('admin.bet.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'user.bets.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.bet.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.bet.index.table.id')</th>
                                <th>@lang('admin.bet.index.table.match')</th>
                                <th>@lang('admin.bet.index.table.team1')</th>
                                <th>@lang('admin.bet.index.table.team2')</th>
                                <th>@lang('admin.bet.index.table.coin')</th>
                                <th>@lang('admin.bet.index.table.betting_date')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($bets as $bet)
                                    <tr>
                                        <td>{{ $bet->id }}</td>
                                        <td>{{ $bet->match->name }}</td>
                                        <td>{{ $bet->match->firstTeam->name }} : <b>{{ $bet->team1_goal }}</b></td>
                                        <td>{{ $bet->match->secondTeam->name }} : <b>{{ $bet->team2_goal }}</b></td>
                                        <td>{{ $bet->coin }}</td>
                                        <td>{{ $bet->betting_date }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('user.bets.edit', ['id' => $bet->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.bet.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['user.bets.destroy', 'id' => $bet->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.bet.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.bet.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" id="no-results">@lang('admin.bet.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($bets) && $bets->lastPage() > 1)
                            {{ $bets->render('admin.pagination.custom') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (session('notification'))
            <div id="notify" data-message="{{ session('notification')['message'] }}" data-type="{{ session('notification')['type'] }}"></div>
            @if (session('notification')['type'] == 'danger')
                <div class="help-block hidden">{{ session('notification')['message'] }}</div>
            @endif
        @endif
    </div>
@endsection
