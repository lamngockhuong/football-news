@extends('public.layouts.app')
@section('title', $team->name)
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            @lang('public.team.title')
        @endslot
        @slot('page_title_breadcrumbs')
            {{ $team->name }}
        @endslot
        @slot('inner_banner')
            {{ asset('templates/public/images/inner-banner/img-03.jpg') }}
        @endslot
    @endcomponent
@endsection
@section('content')
    <main class="main-content">
        <!-- Team Width Sidebar -->
        <div class="team-width-sidebar theme-padding white-bg">
            <div class="container">
                <div class="row">
                    <!-- Team List Content -->
                    <div class="col-lg-9 col-sm-8 pull-right team-s-pull">
                        <h2>{{ $team->name }}</h2>
                        <p>{{ $team->description }}</p>
                        <div class="row">
                            @foreach ($players as $player)
                                <!-- Team Column -->
                                <div class="col-lg-4 col-sm-6 col-xs-6 r-full-width">
                                    <div class="team-column">
                                        <img src="{{ $player->avatar }}" alt="">
                                        <span class="player-number">{{ $player->id }}</span>
                                        <div class="team-detail">
                                            <h5><a href="#">{{ $player->name }}</a></h5>
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
                                <!-- Team Column -->
                            @endforeach
                        </div>
                    </div>
                    <!-- Team List Content -->
                    <!-- Aside -->
                    <div class="col-lg-3 col-sm-4 pull-left team-s-pull">
                    </div>
                    <!-- Aside -->
                </div>
            </div>
        </div>
        <!-- Team Width Sidebar -->
    </main>
@endsection
