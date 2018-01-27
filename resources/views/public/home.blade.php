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
                    </div>
                </div>
                <!-- Match Detail Content -->
            </div>
        </section>
        <!-- Match Detail -->
    </main>
@endsection
