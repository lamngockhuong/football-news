@extends('public.layouts.app')
@section('title', $league->name . ' - ' . trans('public.match.result.title'))
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            {{ $league->name }}
        @endslot
        @slot('page_title_breadcrumbs')
            @lang('public.match.result.title')
        @endslot
    @endcomponent
@endsection
@section('content')
    <!-- Page Heading banner -->
    @if ($upcomingMatch)
        <div class="inner-banner style-2 overlay-dark theme-padding parallax-window" data-appear-top-offset="600"
             data-parallax="scroll" data-image-src="{{ asset('templates/public/images/inner-banner/img-04.jpg') }}">
            <div class="container">
                <div class="pager-heading match-detail white-heading">
                    <span class="pull-left">
                        <img src="{{ $upcomingMatch->firstTeam->logo }}"
                             alt="{{ $upcomingMatch->firstTeam->name }}" width="112">
                    </span>
                    <div class="match-vs-heading position-center-center">
                        <div class="left-tiem-acounter">
                            <ul id="upcoming-countdown" class="countdown" data-countdown="{{ $upcomingMatch->count_down_date }}">
                                <li><span class="days">{{ config('setting.time_zero') }}</span>@lang('public.homepage.D'):</li>
                                <li><span class="hours">{{ config('setting.time_zero') }}</span>@lang('public.homepage.H'):</li>
                                <li><span class="minutes">{{ config('setting.time_zero') }}</span>@lang('public.homepage.M'):</li>
                                <li><span class="seconds">{{ config('setting.time_zero') }}</span>@lang('public.homepage.S')</li>
                            </ul>
                        </div>
                        <span class="result-vs">@lang('public.match.upcoming.vs')</span>
                        <div class="location-marker">
                            <ul>
                                <li><i class="fa fa-map-marker"></i>{{ $upcomingMatch->left_time }}</li>
                                <li><i class="fa fa-map-marker"></i>@lang('public.match.upcoming.location_default')</li>
                            </ul>
                        </div>
                    </div>
                    <span class="pull-right">
                        <img src="{{ $upcomingMatch->secondTeam->logo }}"
                             alt="{{ $upcomingMatch->secondTeam->name }}" width="112">
                    </span>
                </div>
            </div>
        </div>
    @else
        <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll"
             data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
        </div>
    @endif
    <!-- Page Heading banner -->

    <!-- Main Content -->
    <main class="main-content">
        <!-- Match -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">
                    <!-- match Contenet -->
                    <div class="matches-shedule-holder">
                        <div class="col-lg-9 col-sm-8">
                            <!-- Matches Dates Shedule -->
                            <div class="matches-dates-shedule style-2">
                                <div class="result-top-bar">
                                    <span class="pull-left">@lang('public.match.result.match_score')</span>
                                    <span class="pull-right">{{ $league->name }}</span>
                                </div>
                                <ul>
                                    @foreach ($results as $match)
                                        <li>
                                            <span class="pull-left">
                                                <img src="{{ $match->firstTeam->logo }}"
                                                    alt="{{ $match->firstTeam->name }}"
                                                    width="66">
                                            </span>
                                            <span class="pull-right">
                                                <img src="{{ $match->secondTeam->logo }}"
                                                    alt="{{ $match->secondTeam->name }}"
                                                    width="66">
                                            </span>
                                            <div class="detail">
                                                <span class="result-vs">
                                                    {{ $match->team1_goal }}-{{ $match->team2_goal }}
                                                </span>
                                                <div class="location-marker">
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-clock-o"></i>
                                                            {{ $match->end_time }}
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-map-marker"></i>
                                                            @lang('public.match.upcoming.location_default')
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Matches Dates Shedule -->
                            @if (count($results) && $results->lastPage() > 1)
                                {{ $results->render('public.pagination.custom') }}
                            @endif
                        </div>
                    </div>
                    <!-- match Contenet -->

                    <!-- Aside -->
                    <div class="col-lg-3 col-sm-4">
                    </div>
                    <!-- Aside -->
                </div>
            </div>
        </div>
        <!-- Match -->
    </main>
    <!-- Main Content -->
@endsection
