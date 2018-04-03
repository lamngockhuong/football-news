@extends('layouts.app')
@section('title', trans('admin.post.index.title'))
@section('content-title', trans('admin.post.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">
                            <a href="{{ route('posts.index') }}">
                                @lang('admin.post.index.table.title')
                            </a>
                        </h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                            <a href="{{ route('posts.create') }}" class="btn btn-info btn-wd">
                                <i class="fa fa-plus"></i> @lang('admin.post.index.add_button')
                            </a>
                            <a href="{{ route('posts.trashed') }}" class="btn btn-wd">
                                <i class="fa fa-trash"></i> @lang('admin.post.index.trash')
                            </a>
                            <div class="title ranking-search">
                                {{ Form::open(['route' => 'posts.index', 'method' => 'GET']) }}
                                    {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.post.index.table.search_placeholder')]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.post.index.table.id')</th>
                                <th>@lang('admin.post.index.table.name')</th>
                                <th>@lang('admin.post.index.table.image')</th>
                                <th>@lang('admin.post.index.table.category')</th>
                                <th>@lang('admin.post.index.table.user')</th>
                                <th>@lang('admin.post.index.table.created_at')</th>
                                <th>@lang('admin.post.index.table.view_count')</th>
                                <th>@lang('admin.post.index.table.status')</th>
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
                                            <a href="{{ route('posts.index', ['category' => $post->category_id]) }}">
                                                {{ $post->category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.index', ['user' => $post->user_id]) }}">
                                                {{ $post->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $post->publish_date }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>
                                            <label class="switch-button">
                                                <input type="checkbox"{{ $post->is_actived ? ' checked' : '' }} data-url="{{ route('posts.active', ['id' => $post->id]) }}">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('posts.edit', ['id' => $post->id, 'page' => request()->page ? request()->page : '1']) }}"
                                                rel="tooltip" class="btn btn-info btn-link btn-xs"
                                                data-original-title="@lang('admin.post.index.table.edit_button_title')">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {!! Form::open(['route' => ['posts.trash', 'id' => $post->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-trash"></i> ',
                                                    [
                                                        'class' => 'btn btn-link btn-xs',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.post.index.table.trash_button_title'),
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
                                                        'data-original-title' => trans('admin.post.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.post.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" id="no-results">@lang('admin.post.index.table.no_results')</td>
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
