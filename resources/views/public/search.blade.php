@extends('public.layouts.app')
@section('title', $keyword . ' - ' . trans('public.search.title'))
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            @lang('public.search.title')
        @endslot
        @slot('page_title_breadcrumbs')
            @lang('public.search.title')
        @endslot
    @endcomponent
@endsection
@section('content')
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll"
         data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
    </div>
    <main class="main-content">
        <!-- Blog -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">
                    <!-- Blog Content -->
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7 r-full-width">
                        <!-- Blog List View -->
                        <div class="blog-list-View theme-padding-bottom">
                            <!-- Team/League results -->
                            <div class="theme-padding-bottom">
                                <div class="row">
                                    <!-- Team Detail -->
                                    <div class="col-lg-6 col-md-5 col-xs-12">
                                        <h2>@lang('public.team.title')</h2>
                                        @forelse ($teams as $team)
                                            <div class="large-post-detail style-2">
                                                <h2>
                                                    <a href="{{ $team->url }}">
                                                        <i class="fa fa-angle-double-right"></i> {{ $team->name }}
                                                    </a>
                                                </h2>
                                                <p>{!! $team->description !!}</p>
                                            </div>
                                        @empty
                                            <div class="large-post-detail style-2">@lang('public.search.no_results')</div>
                                        @endforelse
                                    </div>
                                    <!-- Team Detail -->
                                    <!-- League Detail -->
                                    <div class="col-lg-6 col-md-5 col-xs-12">
                                        <h2>@lang('public.league.title')</h2>
                                        @forelse ($leagues as $league)
                                            <div class="large-post-detail style-2">
                                                <h2>
                                                    <a href="#">
                                                        <i class="fa fa-angle-double-right"></i> {{ $league->name }}
                                                    </a>
                                                </h2>
                                                <p>
                                                    @lang('public.league.year'): {{ $league->year }} | 
                                                    <a href="{{ $league->result_url }}" target="_blank">@lang('public.search.result')</a> |
                                                    <a href="{{ $league->rank_url }}" target="_blank">@lang('public.search.ranking')</a>
                                                </p>
                                            </div>
                                        @empty
                                            <div class="large-post-detail style-2">@lang('public.search.no_results')</div>
                                        @endforelse
                                    </div>
                                    <!-- League Detail -->
                                </div>
                            </div>
                            <!-- Team/League results -->
                            <!-- Pagination -->
                            @if ((count($teams) && $teams->lastPage() > 1) || (count($leagues) && $leagues->lastPage() > 1))
                                @if (count($teams) > count($leagues))
                                    {{ $teams->render('public.pagination.custom') }}
                                @else
                                    {{ $leagues->render('public.pagination.custom') }}
                                @endif
                            @endif
                            <!-- Pagination -->
                        </div>
                        <!-- Blog List View -->
                    </div>
                    <!-- Blog Content -->
                    <!-- Aside -->
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 r-full-width">
                    </div>
                    <!-- Aside -->
                </div>
            </div>
        </div>
        <!-- Blog -->
    </main>
@endsection
