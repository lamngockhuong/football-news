@extends('layouts.app')
@section('title', trans('admin.event.index.title'))
@section('content-title', trans('admin.event.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">@lang('admin.event.index.table.title')</h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                            <a href="{{ route('match-events.create') }}" class="btn btn-info btn-wd">
                                <i class="fa fa-plus"></i> @lang('admin.event.index.add_button')
                            </a>
                            <div class="title ranking-search">
                                {{ Form::open(['route' => 'match-events.index', 'method' => 'GET']) }}
                                    {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.event.index.table.search_placeholder')]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.event.index.table.id')</th>
                                <th>@lang('admin.event.index.table.name')</th>
                                <th>@lang('admin.event.index.table.image')</th>
                                <th>@lang('admin.event.index.table.match')</th>
                                <th>@lang('admin.event.index.table.user')</th>
                                <th>@lang('admin.event.index.table.created_at')</th>
                                <th>@lang('admin.event.index.table.view_count')</th>
                                <th>@lang('admin.event.index.table.status')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>
                                            <img src="{{ $event->image_url }}" width="100" onerror='this.src="{{ asset('images/no-image.png') }}"'/>
                                        </td>
                                        <td>
                                            <a href="{{ route('match-events.index', ['match' => $event->match_id]) }}">
                                                {{ $event->match->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('match-events.index', ['user' => $event->user_id]) }}">
                                                {{ $event->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $event->created_at }}</td>
                                        <td>{{ $event->view_count }}</td>
                                        <td>
                                            <label class="switch-button">
                                                <input type="checkbox"{{ $event->is_actived ? ' checked' : '' }} data-url="{{ route('match-events.active', ['id' => $event->id]) }}">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('match-events.edit', ['id' => $event->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.event.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['match-events.destroy', 'id' => $event->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.event.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.event.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" id="no-results">@lang('admin.event.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($events) && $events->lastPage() > 1)
                            {{ $events->render('admin.pagination.custom') }}
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
