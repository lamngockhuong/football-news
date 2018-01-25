<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">@lang('admin.navbar.toggle_navigation')</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">@yield('content-title', 'Title')</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-dashboard"></i>
                            <p class="hidden-lg hidden-md">@lang('admin.navbar.dashboard')</p>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-globe"></i>
                            <b class="caret hidden-sm hidden-xs"></b>
                            <span class="notification hidden-sm hidden-xs">5</span>
                            <p class="hidden-lg hidden-md">
                                5 @lang('admin.test')
                                <b class="caret"></b>
                            </p>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">@lang('admin.test')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa fa-search"></i>
                            <p class="hidden-lg hidden-md">@lang('admin.navbar.search')</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (auth()->check())
                        <li>
                            <a href="">
                                <p>@lang('admin.test')</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    @lang('admin.test')
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">@lang('admin.test')</a></li>
                                <li class="divider"></li>
                                <li><a href="#">@lang('admin.test')</a></li>
                            </ul>
                        </li>
                        <li>
                            {{ Form::open(['route' => ['logout'], 'id' => 'logout-form', 'style' => 'display: none;']) }}
                            {{ Form::close() }}
                            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <p>@lang('admin.navbar.logout')</p>
                            </a>
                        </li>
                    @elseif(!isset($exception))
                        <li>
                            <a href="{{ route('login') }}">
                                <p>@lang('admin.navbar.login')</p>
                            </a>
                        </li>
                    @endif
                    <li class="separator hidden-lg hidden-md"></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">
        @yield('content')
    </div>
    @include('light-bootstrap-dashboard::layouts.main-panel.footer.main')
</div>
