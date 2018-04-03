@extends('public.layouts.app')
@section('title', 'Home')
@section('content')
    <main class="main-content">
        <!-- Match Detail -->
        <section class="theme-padding-bottom bg-fixed">
            <div class="container">
                <!-- Add Banners -->
                <div class="add-banners">
                    <ul id="add-banners-slider" class="add-banners-slider">
                        <li>
                            <a href="#">
                                <img src="{{ asset('templates/public/images/add-banners/img-01.jpg') }}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('templates/public/images/add-banners/img-02.jpg') }}" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{ asset('templates/public/images/add-banners/img-03.jpg') }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Add Banners -->
                <!-- Match Detail Content -->
                <div class="match-detail-content">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="row">
                                <!-- Next Matches -->
                                <div class="col-sm-4 col-xs-5 r-full-width">
                                    <div class="next-matches">
                                        <h4>@lang('public.homepage.next_match')</h4>
                                        <div id="matches-detail-slider" class="matches-detail-slider">
                                            @foreach ($nextMatches as $match)
                                                <!-- Item -->
                                                <div class="item matches-detail next-match-detail">
                                                    <div class="time-left">
                                                        <ul id="countdown-{{ $loop->iteration }}" class="countdown" data-countdown="{{ $match->count_down_date }}">
                                                            <li><span class="days">{{ config('setting.time_zero') }}</span>@lang('public.homepage.D'):</li>
                                                            <li><span class="hours">{{ config('setting.time_zero') }}</span>@lang('public.homepage.H'):</li>
                                                            <li><span class="minutes">{{ config('setting.time_zero') }}</span>@lang('public.homepage.M'):</li>
                                                            <li><span class="seconds">{{ config('setting.time_zero') }}</span>@lang('public.homepage.S')</li>
                                                        </ul>
                                                    </div>
                                                    <span class="left-date">{{ $match->left_time }}</span>
                                                    <div class="team-btw-match">
                                                        <ul>
                                                            <li>
                                                                <img src="{{ $match->firstTeam->logo }}"
                                                                     alt="{{ $match->firstTeam->name }}" width="61">
                                                                <a href="{{ $match->firstTeam->url }}">
                                                                    <span>{{ $match->firstTeam->name }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <img src="{{ $match->secondTeam->logo }}"
                                                                     alt="{{ $match->firstTeam->name }}" width="61">
                                                                <a href="{{ $match->secondTeam->url }}">
                                                                    <span>{{ $match->secondTeam->name }}</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- Item -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Next Matches -->

                                <!-- Upcoming Fixture -->
                                <div class="col-sm-8 col-xs-7 r-full-width">
                                    <h3>
                                        <span><i class="red-color">@lang('public.homepage.upcoming') </i>@lang('public.homepage.fixture')</span>
                                        <a class="view-all pull-right" href="{{ route('match.upcoming') }}">
                                            @lang('public.homepage.view_all')<i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </h3>
                                    <div class="upcoming-fixture">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    @foreach ($nextMatches as $match)
                                                        <tr>
                                                            <td>
                                                                <div class="logo-width-name">
                                                                    <img src="{{ $match->firstTeam->logo }}"
                                                                         alt="{{ $match->firstTeam->name }}" width="29">
                                                                    <a href="{{ $match->firstTeam->url }}">
                                                                        {{ $match->firstTeam->name }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td class="upcoming-fixture-date">
                                                                <span>{{ $match->left_time }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="logo-width-name w-icon">
                                                                    <img src="{{ $match->secondTeam->logo }}"
                                                                         alt="{{ $match->secondTeam->name }}"
                                                                         width="29">
                                                                    <a href="{{ $match->secondTeam->url }}">
                                                                        {{ $match->secondTeam->name }}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upcoming Fixture -->

                                <!-- Latest News -->
                                <div class="col-xs-12">
                                    <div class="latest-news-holder">
                                        <h3><span>@lang('public.homepage.latest_news')</span></h3>
                                        <!-- latest-news Slider -->
                                        <div class="row no-gutters white-bg">
                                            <!-- Slider -->
                                            <div class="col-sm-9">
                                                <ul id="latest-news-slider" class="latest-news-slider">
                                                    @foreach($posts as $post)
                                                        <li>
                                                            <img src="{{ $post->image }}" alt="{{ $post->title }}">
                                                            <p>{{ $post->description }}...<a href="{{ $post->url }}">@lang('public.homepage.read_more')</a></p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Slider -->
                                            <!-- Thumnail -->
                                            <div class="col-sm-3">
                                                <ul id="latest-news-thumb" class="latest-news-thumb">
                                                    @foreach($posts as $post)
                                                        <li>
                                                            <p>{{ $post->title }}</p>
                                                            <span>{{ $post->publishDate }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <ul class="news-thumb-arrows">
                                                    <li class="prev"><span class="fa fa-angle-up"></span></li>
                                                    <li class="next"><span class="fa fa-angle-down"></span></li>
                                                </ul>
                                            </div>
                                            <!-- Thumnail -->
                                        </div>
                                        <!-- latest-news Slider -->
                                    </div>
                                </div>
                                <!-- Latest News -->
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Match Detail Content -->
            </div>
        </section>
        <!-- Match Detail -->
    </main>
@endsection
