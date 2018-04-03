@extends('layouts.app')
@section('title', trans('admin.country.index.title'))
@section('content-title', trans('admin.country.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if (isset($country))
                        <div class="header">
                            <h4 class="title">@lang('admin.country.index.edit.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::model($country, ['route' => ['countries.update', $country->id], 'method' => 'PUT']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.country.index.edit.name')) }}
                                            {{ Form::hidden('id', old('id')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.country.index.edit.name_placeholder')
                                            ])}}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.country.index.edit.submit_button'), [
                                    'class' => 'btn btn-info btn-fill pull-right',
                                    'type' => 'submit'
                                ]) }}
                                <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    @else
                        <div class="header">
                            <h4 class="title">@lang('admin.country.index.add.title')</h4>
                        </div>
                        <div class="content">
                            {{ Form::open(['route' => 'countries.store']) }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            {{ Form::label('name', trans('admin.country.index.add.name')) }}
                                            {{ Form::text('name', old('name'), [
                                                'class' => 'form-control',
                                                'placeholder' => trans('admin.country.index.add.name_placeholder')
                                            ]) }}
                                            @if ($errors->has('name'))
                                                <span class="help-block">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{ Form::button(trans('admin.country.index.add.submit_button'), [
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
                        <h4 class="title">@lang('admin.country.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="title">
                            {{ Form::open(['route' => 'countries.index', 'method' => 'GET']) }}
                                {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.country.index.table.search_placeholder')]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.country.index.table.id')</th>
                                <th>@lang('admin.country.index.table.name')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('countries.edit', ['id' => $country->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.country.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['countries.destroy', 'id' => $country->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.country.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.country.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" id="no-results">@lang('admin.country.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($countries) && $countries->lastPage() > 1)
                            {{ $countries->render('admin.pagination.custom') }}
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
