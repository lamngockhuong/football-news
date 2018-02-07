@extends('layouts.app')
@section('title', trans('admin.event.trashed.title'))
@section('content-title', trans('admin.event.trashed.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">
                            <a href="{{ route('match-events.trashed') }}">
                                @lang('admin.event.trashed.table.title')
                            </a>
                        </h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                            <a href="{{ route('match-events.index') }}" class="btn btn-info btn-wd">
                                <i class="fa fa-list"></i> @lang('admin.event.trashed.list')
                            </a>
                            <div class="title ranking-search">
                                {{ Form::open(['route' => 'match-events.trashed', 'method' => 'GET']) }}
                                    {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.event.trashed.table.search_placeholder')]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.event.trashed.table.id')</th>
                                <th>@lang('admin.event.trashed.table.name')</th>
                                <th>@lang('admin.event.trashed.table.image')</th>
                                <th>@lang('admin.event.trashed.table.match')</th>
                                <th>@lang('admin.event.trashed.table.user')</th>
                                <th>@lang('admin.event.trashed.table.created_at')</th>
                                <th>@lang('admin.event.trashed.table.deleted_at')</th>
                                <th>@lang('admin.event.trashed.table.view_count')</th>
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
                                            <a href="{{ route('match-events.trashed', ['match' => $event->match_id]) }}">
                                                {{ $event->match->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('match-events.trashed', ['user' => $event->user_id]) }}">
                                                {{ $event->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $event->publish_date }}</td>
                                        <td>{{ $event->delete_date }}</td>
                                        <td>{{ $event->view_count }}</td>
                                        <td class="td-actions text-right">
                                            {!! Form::open(['route' => ['match-events.untrash', 'id' => $event->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-undo"></i> ',
                                                    [
                                                        'class' => 'btn btn-warning btn-link btn-xs',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.event.trashed.table.undo_button_title'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => ['match-events.destroy', 'id' => $event->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.event.trashed.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.event.trashed.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" id="no-results">@lang('admin.event.trashed.table.no_results')</td>
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
