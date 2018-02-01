@extends('layouts.app')
@section('title', trans('admin.team.index.title'))
@section('content-title', trans('admin.team.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @if (isset($team))
                        <div class="header">
                            <h4 class="title">@lang('admin.team.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($team, ['route' => ['teams.update', $team->id], 'method' => 'PUT', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.team.index.edit.name')) }}
                                            {{ Form::hidden('id', old('id')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.team.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                            {{ Form::label('country_id', trans('admin.team.index.edit.country')) }}
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"{{ (old('country_id') == $country->id) || ($team->country_id == $country->id) ? ' selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="help-block">{{ $errors->first('country_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                            {{ Form::label('image', trans('admin.team.index.edit.logo')) }}
                                            {{ Form::file('image', ['class' => 'form-control']) }}
                                            @if ($errors->has('image'))
                                                <span class="help-block">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ $team->logo_url }}" target="_blank">
                                                <img src="{{ $team->logo_url }}" width="250" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.team.index.edit.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.team.index.edit.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.team.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.team.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'teams.store', 'files' => true]) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.team.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.team.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                            {{ Form::label('country_id', trans('admin.team.index.add.country')) }}
                                            <select name="country_id" class="form-control">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"{{ old('country_id') == $country->id ? ' selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="help-block">{{ $errors->first('country_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                            {{ Form::label('image', trans('admin.team.index.add.logo')) }}
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
                                            {{ Form::label('description', trans('admin.team.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.team.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.team.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.team.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'teams.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.team.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.team.index.table.id')</th>
                                <th>@lang('admin.team.index.table.logo')</th>
                                <th>@lang('admin.team.index.table.name')</th>
                                <th>@lang('admin.team.index.table.country')</th>
                                <th>@lang('admin.team.index.table.description')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($teams as $team)
                                    <tr>
                                        <td>{{ $team->id }}</td>
                                        <td>
                                            <img src="{{ $team->logo_url }}" width="50"/>
                                        </td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->country->name }}</td>
                                        <td>{{ $team->description }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('teams.edit', ['id' => $team->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.team.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['teams.destroy', 'id' => $team->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.team.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.team.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" id="no-results">@lang('admin.team.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($teams) && $teams->lastPage() > 1)
                            {{ $teams->render('admin.pagination.custom') }}
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
