@extends('layouts.app')

@section('content-title')
<span class="text-warning">@lang('admin.404')</span>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="header">
                <h4 class="title">@lang('admin.oops') {{ class_basename($exception->getPrevious() ? : $exception) }}</h4>
            </div>
            @if($exception->getMessage())
                <div class="content">
                    {{ $exception->getPrevious() ? $exception->getPrevious()->getMessage() : $exception->getMessage() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
