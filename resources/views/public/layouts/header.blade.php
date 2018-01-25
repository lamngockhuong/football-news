<header class="header style-3">
    <!-- Top bar -->
    <div class="topbar-and-logobar">
        <div class="container">
            <!-- Responsive Button -->
            <div class="responsive-btn pull-right">
                <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Responsive Button -->
            <!-- User Login Option -->
            <ul class="user-login-option pull-right">
                <li class="social-icon">
                    <ul class="social-icons style-5">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
                        <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                    </ul>
                </li>
                <li class="login-modal">
                    <a href="#" class="login" data-toggle="modal" data-target="#login-modal">
                        <i class="fa fa-user"></i>@lang('public.header.member_login')</a>
                    <div class="modal fade" id="login-modal">
                        <div class="login-form position-center-center">
                            <h2>@lang('auth.login')
                                <button class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h2>
                            {{ Form::open(['route' => ['login']]) }}
                                <div class="form-group">
                                    {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'domain@live.com']) }}
                                    <i class=" fa fa-envelope"></i>
                                </div>
                                <div class="form-group">
                                    {{ Form::password('password', ['class' => 'form-control']) }}
                                    <i class=" fa fa-lock"></i>
                                </div>
                                <div class="form-group custom-checkbox">
                                    <label>
                                        <input type="checkbox"> @lang('auth.remember')
                                    </label>
                                    <a class="pull-right forgot-password" href="#"></a>
                                    <a href="#" class="pull-right forgot-password" data-toggle="modal"
                                       data-target="#login-modal-2">@lang('auth.forgot_password')</a>
                                </div>
                                <div class="form-group">
                                    <button class="btn full-width red-btn">@lang('auth.login')</button>
                                </div>
                            {{ Form::close() }}
                            <span class="or-reprater"></span>
                            <ul class="others-login-way">
                                <li><a class="facebook-bg" href="#"><i class="fa fa-facebook"></i>@lang('public.header.facebook')</a></li>
                                <li><a class="tweet-bg" href="#"><i class="fa fa-twitter"></i>@lang('public.header.tweet')</a></li>
                                <li><a class="linkedin-bg" href="#"><i class="fa fa-linkedin"></i>@lang('public.header.linkedin')</a></li>
                                <li><a class="google-plus-bg" href="#"><i class="fa fa-google-plus"></i>@lang('public.header.google_plus')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal fade" id="login-modal-2">
                        <div class="login-form position-center-center">
                            <h2>@lang('auth.forgot_password')
                                <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                                </button>
                            </h2>
                            {{ Form::open(['route' => ['password.email']]) }}
                                <div class="form-group">
                                    {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'domain@live.com']) }}
                                    <i class=" fa fa-envelope"></i>
                                </div>
                                <div class="form-group">
                                    {{ Form::password('password', ['class' => 'form-control']) }}
                                    <i class=" fa fa-lock"></i>
                                </div>
                                <div class="form-group">
                                    <button class="btn full-width red-btn">@lang('auth.send_reset_link')</button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </li>
                <li class="language-dropdown">
                    <a id="choses-lang" href="#"><i class="fa fa-globe"></i>@lang('public.header.lang_eng')<i class="fa fa-caret-down"></i></a>
                    <ul id="language-dropdown">
                        <li>
                            <a href="#"><img src="{{ asset('templates/public/images/flags/img-02.jpg') }}" alt="">@lang('public.header.lang_ger')</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- User Login Option -->
        </div>
    </div>
    <!-- Top bar -->
    <!-- Nav -->
    <div class="nav-holder">
        <div class="container">
            <div class="maga-drop-wrap">
                <!-- Logo -->
                <div class="logo">
                    <a href=""><img src="{{ asset('templates/public/images/logo-4.png') }}" alt=""></a>
                </div>
                <!-- Logo -->
                <!-- Search Bar -->
                <div class="search-bar-holder pull-right">
                    <div class="search-bar">
                        <input type="text" class="form-control" placeholder="@lang('public.header.search_placeholder')">
                        <i class="fa fa-search"></i>
                    </div>
                </div>
                <!-- Search Bar -->
                <!-- Nav List -->
                <ul class="nav-list pull-right">
                    <li><a href="">@lang('public.test')</a></li>
                </ul>
                <!-- Nav List -->
            </div>
        </div>
    </div>
    <!-- Nav -->
</header>
