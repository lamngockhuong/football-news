@extends('layouts.app')
@section('title', trans('admin.league.index.title'))
@section('content-title', trans('admin.league.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    @if (isset($league))
                        <div class="header">
                            <h4 class="title">@lang('admin.league.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($league, ['route' => ['leagues.update', $league->id], 'method' => 'PUT']) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.league.index.edit.name')) }}
                                            {{ Form::hidden('id', old('id')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.league.index.edit.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                            {{ Form::label('year', trans('admin.league.index.edit.year')) }}
                                            {{ Form::number('year', old('year'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'placeholder' => trans('admin.league.index.edit.year_placeholder')
                                            ]) }}
                                            @if ($errors->has('year'))
                                                <span class="help-block">{{ $errors->first('year') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.league.index.edit.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.league.index.edit.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.league.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.league.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'leagues.store']) }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.league.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.league.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                            {{ Form::label('year', trans('admin.league.index.add.year')) }}
                                            {{ Form::number('year', old('year'), [
                                                'class' => 'form-control',
                                                'min' => 0,
                                                'placeholder' => trans('admin.league.index.add.year_placeholder')
                                            ]) }}
                                            @if ($errors->has('year'))
                                                <span class="help-block">{{ $errors->first('year') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            {{ Form::label('description', trans('admin.league.index.add.description')) }}
                                            {{ Form::textarea('description', old('description'), [
                                                'class' => 'form-control',
                                                'rows' => 10,
                                                'placeholder' => trans('admin.league.index.add.description_placeholder')
                                            ]) }}
                                            @if ($errors->has('description'))
                                                <span class="help-block">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.league.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.league.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'leagues.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.league.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.league.index.table.id')</th>
                                <th>@lang('admin.league.index.table.name')</th>
                                <th>@lang('admin.league.index.table.year')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($leagues as $league)
                                    <tr>
                                        <td>{{ $league->id }}</td>
                                        <td>{{ $league->name }}</td>
                                        <td>{{ $league->year }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('leagues.edit', ['id' => $league->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.league.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['leagues.destroy', 'id' => $league->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.league.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.league.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" id="no-results">@lang('admin.league.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($leagues) && $leagues->lastPage() > 1)
                            {{ $leagues->render('admin.pagination.custom') }}
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
