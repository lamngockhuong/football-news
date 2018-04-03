@extends('public.layouts.app')
@section('title', $player->name)
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            {{ $player->team->name }}
        @endslot
        @slot('page_title_breadcrumbs')
            @lang('public.team.title')
        @endslot
    @endcomponent
@endsection
@section('content')
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll"
         data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
    </div>
    <main class="main-content">
        <!-- Team Detail -->
        <div class="team-detail-holder theme-padding white-bg">
            <div class="container">
                <!-- Row Holder -->
                <div class="row">
                    <!-- Team without Hover -->
                    <div class="col-lg-3 col-md-3 col-sm-5">
                        <div class="team-column without-hover">
                            <img src="{{ $player->avatar }}" alt="{{ $player->name }}">
                            <span class="player-number">{{ $player->id }}</span>
                            <div class="team-detail">
                                <h5>{{ $player->name }}</h5>
                                <span class="desination">{{ $player->position->name }}</span>
                                <div class="detail-inner">
                                    <ul>
                                        <li>@lang('public.player.born')</li>
                                        <li>@lang('public.player.position')</li>
                                        <li>@lang('public.player.country')</li>
                                        <li>@lang('public.team.show.follow_us_on')</li>
                                    </ul>
                                    <ul>
                                        <li>{{ $player->birthday }}</li>
                                        <li>{{ $player->position->name }}</li>
                                        <li>{{ $player->country->name }}</li>
                                        <li>
                                            <ul class="social-icons">
                                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
                                                <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Team without Hover -->

                    <!-- Detail -->
                    <div class="col-lg-9 col-md-9 col-sm-7">
                        <!-- Team Detail Content -->
                        <div class="team-detail-content theme-padding-bottom">
                            <h2>@lang('public.player.show.overview')</h2>
                            <p>@lang('public.player.born') : {{ $player->birthday }}</p>
                            <p>@lang('public.player.position') : {{ $player->position->name }}</p>
                            <p>@lang('public.player.country') : {{ $player->country->name }}</p>
                            <blockquote>
                                <p>{!! $player->description !!}</p>
                            </blockquote>
                            <div class="tags-holder">
                                <ul class="social-icons pull-right">
                                    <li>@lang('public.player.show.share')</li>
                                    <li>
                                        <a class="facebook" href="http://www.facebook.com/sharer.php?u={{ $player->share_url }}" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter" href="http://twitter.com/share?text={{ $player->name }}&url={{ $player->share_url }}" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="google" href="https://plus.google.com/share?url={{ $player->share_url }}" target="_blank">
                                            <i class="fa fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="pinterest"
                                           href="http://pinterest.com/pin/create/button/?url={{ $player->share_url }}&media={{ $player->avatar }}&description={{ $player->description }}"
                                           target="_blank">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Team Detail Content -->
                    </div>
                    <!-- Detail -->
                </div>
                <!-- Row Holder  -->
            </div>
        </div>
        <!-- Team Detail -->
    </main>
@endsection
