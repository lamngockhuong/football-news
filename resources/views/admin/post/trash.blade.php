@extends('layouts.app')
@section('title', trans('admin.post.trashed.title'))
@section('content-title', trans('admin.post.trashed.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">
                            <a href="{{ route('posts.trashed') }}">
                                @lang('admin.post.trashed.table.title')
                            </a>
                        </h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                            <a href="{{ route('posts.index') }}" class="btn btn-info btn-wd">
                                <i class="fa fa-list"></i> @lang('admin.post.trashed.list')
                            </a>
                            <div class="title ranking-search">
                                {{ Form::open(['route' => 'posts.trashed', 'method' => 'GET']) }}
                                    {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.post.trashed.table.search_placeholder')]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.post.trashed.table.id')</th>
                                <th>@lang('admin.post.trashed.table.name')</th>
                                <th>@lang('admin.post.trashed.table.image')</th>
                                <th>@lang('admin.post.trashed.table.category')</th>
                                <th>@lang('admin.post.trashed.table.user')</th>
                                <th>@lang('admin.post.trashed.table.created_at')</th>
                                <th>@lang('admin.post.trashed.table.deleted_at')</th>
                                <th>@lang('admin.post.trashed.table.view_count')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <img src="{{ $post->image_url }}" width="100" onerror='this.src="{{ asset('images/no-image.png') }}"'/>
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.trashed', ['category' => $post->category_id]) }}">
                                                {{ $post->category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.trashed', ['user' => $post->user_id]) }}">
                                                {{ $post->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $post->publish_date }}</td>
                                        <td>{{ $post->delete_date }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td class="td-actions text-right">
                                            {!! Form::open(['route' => ['posts.untrash', 'id' => $post->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-undo"></i> ',
                                                    [
                                                        'class' => 'btn btn-warning btn-link btn-xs',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.post.trashed.table.undo_button_title'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                            {!! Form::open(['route' => ['posts.destroy', 'id' => $post->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.post.trashed.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.post.trashed.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" id="no-results">@lang('admin.post.trashed.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($posts) && $posts->lastPage() > 1)
                            {{ $posts->render('admin.pagination.custom') }}
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
