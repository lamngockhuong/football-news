@extends('public.layouts.app')
@section('title', trans('public.403'))
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            @lang('public.403')
        @endslot
        @slot('page_title_breadcrumbs') 
            @lang('public.403')
        @endslot
    @endcomponent
@endsection
@section('content')
    <div class="overlay-dark theme-padding parallax-window"
        data-appear-top-offset="600" data-parallax="scroll"
        data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
    </div>
    <main class="main-content">
        <!-- 403 Error -->
        <div class="error-holder theme-padding">
            <div class="container">
                <div class="error-content-holder">
                    <div class="error-content">
                        <h1>4<i class="fa fa-futbol-o"></i>3<span class="font-open-sans">@lang('public.error')</span></h1>
                        <p>@lang('public.403_sorry')</p>
                        <a class="btn red-btn" href="{{ route('home') }}">@lang('public.back_to_homepage')</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 403 Error -->
    </main>
@endsection
