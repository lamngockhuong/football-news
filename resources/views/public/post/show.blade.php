@extends('public.layouts.app')
@section('title', $post->title)
@section('page-heading')
    @component('public.layouts.page-heading')
        @slot('page_title')
            {{ $post->category->name }}
        @endslot
        @slot('page_title_breadcrumbs')
            {{ $post->category->name }}
        @endslot
    @endcomponent
@endsection
@section('content')
    <div class="overlay-dark theme-padding parallax-window" data-appear-top-offset="600" data-parallax="scroll"
         data-image-src="{{ asset('templates/public/images/inner-banner/img-03.jpg') }}">
    </div>
    <main class="main-content">
        <!-- Blog Detail -->
        <div class="theme-padding white-bg">
            <div class="container">
                <div class="row">
                    <!-- Blog Content -->
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-12">
                        <!-- Blog detail -->
                        <div class="blog-detail-holder">
                            <div class="author-header">
                                <h2>{{ $post->title }}</h2>
                                <div class="aurhor-img-name pull-left">
                                    <img src="{{ $post->user->avatar }}" alt="" width="48" height="48">
                                    <strong>@lang('public.post.show.by') <i class="red-color">{{ $post->user->name }}</i></strong>
                                    <span>@lang('public.post.show.on_date') {{ $post->publishDate }} </span>
                                </div>
                                <div class="share-option pull-right">
                                    <span id="share-btn1"><i class="fa fa-share-alt"></i>Share</span>
                                    <div id="show-social-icon1" class="on-hover-share">
                                        <ul class="social-icons">
                                            <li>
                                                <a class="facebook" href="http://www.facebook.com/sharer.php?u={{ $post->share_url }}" target="_blank">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ $post->share_url }}" target="_blank">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="google" href="https://plus.google.com/share?url={{ $post->share_url }}" target="_blank">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pinterest"
                                                   href="http://pinterest.com/pin/create/button/?url={{ $post->share_url }}&media={{ $post->image }}&description={{ $post->description }}"
                                                   target="_blank">
                                                    <i class="fa fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <article>
                                <p>{{ $post->description }}</p>
                            </article>
                            <div class="blog-detail">
                                <figure>
                                    <img src="{{ $post->image }}" alt="">
                                </figure>
                                <article>
                                    {{ $post->content }}
                                </article>
                            </div>
                            <div class="tags-holder">
                                <ul class="social-icons pull-right">
                                    <li>@lang('public.post.show.share_this_post')</li>
                                    <li>
                                        <a class="facebook" href="http://www.facebook.com/sharer.php?u={{ $post->share_url }}" target="_blank">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="twitter" href="http://twitter.com/share?text={{ $post->title }}&url={{ $post->share_url }}" target="_blank">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="google" href="https://plus.google.com/share?url={{ $post->share_url }}" target="_blank">
                                            <i class="fa fa-google"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="pinterest"
                                           href="http://pinterest.com/pin/create/button/?url={{ $post->share_url }}&media={{ $post->image }}&description={{ $post->description }}"
                                           target="_blank">
                                            <i class="fa fa-pinterest-p"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="next-prev-option">
                                @if ($prevPost)
                                    <a href="{{ $prevPost->url }}" class="prev-blog pull-left">
                                        <img src="{{ $prevPost->image }}" alt="{{ $prevPost->title }}" width="112" height="71">
                                        <span><i class="fa fa-angle-left"></i>@lang('public.post.show.previous_post')</span>
                                        <h5>{{ $prevPost->title }}</h5>
                                        <span class="m-0">{{ $prevPost->publishDate }}</span>
                                    </a>
                                @endif
                                @if ($nextPost)
                                    <a href="{{ $nextPost->url }}" class="next-blog pull-right">
                                        <img src="{{ $nextPost->image }}" alt="{{ $nextPost->title }}" width="112" height="71">
                                        <span>@lang('public.post.show.next_post')<i class="fa fa-angle-right"></i></span>
                                        <h5>{{ $nextPost->title }}</h5>
                                        <span class="m-0">{{ $nextPost->publishDate }}</span>
                                    </a>
                                @endif
                            </div>
                            <div class="about-aurthor-holder theme-margin-bottom">
                                <div class="about-aurthor">
                                    <img src="{{ $post->user->avatar }}" alt="" width="80" height="80">
                                    <h5>
                                        {{ $post->user->name }} <i class="red-color">(@lang('public.post.show.author_level.' . $post->user->is_admin ))</i>
                                    </h5>
                                    <p>@lang('public.post.show.author_description')</p>
                                </div>
                            </div>
                        </div>
                        <!-- Blog Detail -->
                    </div>
                    <!-- Blog Content -->

                    <!-- Aside -->
                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
                        <!-- Aside Widget -->
                        <div class="aside-widget">
                            <h3><span>@lang('public.widget.archive')</span></h3>
                            <div id="calendar" class="calendar"></div>
                        </div>
                        <!-- Aside Widget -->
                    </div>
                    <!-- Aside -->
                </div>
            </div>
        </div>
        <!-- Blog Detail -->
    </main>
@endsection
