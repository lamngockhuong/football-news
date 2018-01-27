<!doctype html>
<html class="no-js" lang="{{ config('app.locale', 'en') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content=""/>
    <meta property="og:title" content="Ali Umair"/>
    <meta property="og:description" content="Ali UMair is a web developer"/><meta property="og:image" content="../image" />
    <title>@yield('title')</title>
    {{ Html::style('templates/public/css/app.css') }}
    {{ Html::style('templates/public/css/main.css') }}
    {{ Html::style('templates/public/css/transition.css') }}
    {{ Html::style('templates/public/css/style.css') }}
    {{ Html::style('templates/public/css/color.css') }}
    {{ Html::style('templates/public/css/responsive.css') }}
    {{ Html::script('templates/public/js/modernizr.js') }}
</head>
<body>
    <!-- Wrapper -->
    <div class="wrap push">
        <!-- Header -->
        @include('public.layouts.header')
        <!-- Header -->

        <!-- Page Heading -->
        @yield('page-heading')
        <!-- Page Heading -->

        <!-- Slider Holder -->
        @yield('slider-holder')
        <!-- Slider Holder -->

        <!-- Main Content -->
        @section('content')
        @show
        <!-- Main Content -->

        <!-- Footer -->
        @include('public.layouts.footer')
        <!-- Footer -->
    </div>
    <!-- Wrapper -->

    <!-- Slide Menu -->
    @include('public.layouts.slide-menu')
    <!-- Slide Menu -->

    <!-- Java Script -->
    {{ Html::script('templates/public/js/jquery.js') }}
    {{ Html::script('templates/public/js/bootstrap.min.js') }}
    {{ Html::script('http://maps.google.com/maps/api/js?sensor=false') }}
    {{ Html::script('templates/public/js/gmap3.min.js') }}
    {{ Html::script('templates/public/js/bigslide.js') }}
    {{ Html::script('templates/public/js/slick.js') }}
    {{ Html::script('templates/public/js/waterwheelCarousel.js') }}
    {{ Html::script('templates/public/js/contact-form.js') }}
    {{ Html::script('templates/public/js/countTo.js') }}
    {{ Html::script('templates/public/js/datepicker.js') }}
    {{ Html::script('templates/public/js/rating-star.js') }}
    {{ Html::script('templates/public/js/range-slider.js') }}
    {{ Html::script('templates/public/js/spinner.js') }}
    {{ Html::script('templates/public/js/parallax.js') }}
    {{ Html::script('templates/public/js/countdown.js') }}
    {{ Html::script('templates/public/js/appear.js') }}
    {{ Html::script('templates/public/js/prettyPhoto.js') }}
    {{ Html::script('templates/public/js/wow-min.js') }}
    {{ Html::script('templates/public/js/main.js') }}
</body>
</html>
