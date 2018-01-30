@extends('public.layouts.app')
@section('title', '')
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            
        @endslot
        @slot('page_title_breadcrumbs')
            @lang('public.rank.title')
        @endslot
    @endcomponent
@endsection
@section('content')
    <!-- Page Heading banner -->
    @if ($upcomingMatch)
        <div class="inner-banner style-2 overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll"
            data-image-src="{{ asset('templates/public/images/inner-banner/img-04.jpg') }}">
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
        <!-- Match Result -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">
                    <!-- Aside -->
                    <div class="col-lg-3 col-sm-4">
                    </div>
                    <!-- Aside -->
                    
                    <!-- Match Result Contenet -->
                    <div class="col-lg-9 col-sm-8">
                        <!-- Piont Table -->
                        <div class="macth-fixture">
                            <h5>{{ $league->name }}</h5>
                            <div class="last-matches styel-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('public.rank.show.table.index')</th>
                                                <th>@lang('public.rank.show.table.team')</th>
                                                <th>@lang('public.rank.show.table.won')</th>
                                                <th>@lang('public.rank.show.table.drawn')</th>
                                                <th>@lang('public.rank.show.table.lost')</th>
                                                <th>@lang('public.rank.show.table.goals_for')</th>
                                                <th>@lang('public.rank.show.table.goals_against')</th>
                                                <th>@lang('public.rank.show.table.goal_difference')</th>
                                                <th>@lang('public.rank.show.table.score')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ranks as $rank)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ $rank->team->logo }}" 
                                                            alt="{{ $rank->team->name }}"
                                                            width="19">
                                                        {{ $rank->team->name }}
                                                    </td>
                                                    <td>{{ $rank->won }}</td>
                                                    <td>{{ $rank->drawn }}</td>
                                                    <td>{{ $rank->lost }}</td>
                                                    <td>{{ $rank->goals_for }}</td>
                                                    <td>{{ $rank->goals_against }}</td>
                                                    <td>{{ $rank->goal_difference }}</td>
                                                    <td>{{ $rank->score }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Piont Table -->
                    </div>
                    <!-- Match Result Contenet -->
                </div>
            </div>
        </div>
        <!-- Match Result -->
    </main>
    <!-- Main Content -->
@endsection
