@extends('layouts.app')
@section('title', trans('admin.comment.index.title'))
@section('content-title', trans('admin.comment.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">
                            <a href="{{ route('comments.index') }}">
                                @lang('admin.comment.index.table.title')
                            </a>
                        </h4>
                    </div>
                    <div class="header pull-right">
                        <div class="form-inline">
                            <div class="title ranking-search">
                                {{ Form::open(['route' => 'comments.index', 'method' => 'GET']) }}
                                    {{ Form::text('q', null, ['class' => 'form-control', 'placeholder' => trans('admin.comment.index.table.search_placeholder')]) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>@lang('admin.comment.index.table.id')</th>
                                <th>@lang('admin.comment.index.table.content')</th>
                                <th>@lang('admin.comment.index.table.post')</th>
                                <th>@lang('admin.comment.index.table.user')</th>
                                <th>@lang('admin.comment.index.table.created_at')</th>
                                <th>@lang('admin.comment.index.table.status')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>
                                            <a href="{{ route('comments.index', ['post' => $comment->post_id]) }}">
                                                {{ $comment->post->title }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('comments.index', ['user' => $comment->user_id]) }}">
                                                {{ $comment->user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $comment->comment_date }}</td>
                                        <td>
                                            <label class="switch-button">
                                                <input type="checkbox"{{ $comment->is_actived ? ' checked' : '' }} data-url="{{ route('comments.active', ['id' => $comment->id]) }}">
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="td-actions text-right">
                                            {!! Form::open(['route' => ['comments.destroy', 'id' => $comment->id]]) !!}
                                                {{ method_field('DELETE') }}
                                                {!! Form::button('<i class="fa fa-times"></i> ',
                                                    [
                                                        'class' => 'btn btn-danger btn-link btn-xs delete-button',
                                                        'type' => 'submit',
                                                        'rel' => 'tooltip',
                                                        'data-original-title' => trans('admin.comment.index.table.remove_button_title'),
                                                        'data-delete-confirm' => trans('admin.comment.index.table.message.delete_confirm'),
                                                    ])
                                                !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" id="no-results">@lang('admin.comment.index.table.no_results')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (count($comments) && $comments->lastPage() > 1)
                            {{ $comments->render('admin.pagination.custom') }}
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
