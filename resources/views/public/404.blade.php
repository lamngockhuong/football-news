@extends('public.layouts.app')
@section('title', trans('public.404'))
@section('page-heading-breadcrumbs-section')
    <h2>@lang('public.404')</h2>
    <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">@lang('public.home')</a></li>
        <li>@lang('public.404')</li>
    </ul>
@endsection
@section('page-heading-banner')
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll" data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
    </div>
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
