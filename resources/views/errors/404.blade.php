@extends('public.layouts.app')
@section('title', trans('public.404'))
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            @lang('public.404')
        @endslot
        @slot('inner_banner')
            {{ asset('templates/public/images/inner-banner/img-03.jpg') }}
        @endslot
    @endcomponent
@endsection
@section('content')
    <main class="main-content">
        <!-- 404 Error -->
        <div class="error-holder theme-padding">
            <div class="container">
                <div class="error-content-holder">
                    <div class="error-content">
                        <h1>4<i class="fa fa-futbol-o"></i>4<span class="font-open-sans">@lang('public.error')</span></h1>
                        <p>@lang('public.404_sorry')</p>
                        <a class="btn red-btn" href="{{ route('home') }}">@lang('public.back_to_homepage')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 Error -->
    </main>
@endsection
