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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (auth()->check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    @lang('admin.navbar.account')
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('user.profiles.show', ['id' => auth()->user()->id]) }}">
                                        @lang('admin.navbar.view_profile')
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.profiles.edit', ['id' => auth()->user()->id]) }}">
                                        @lang('admin.navbar.edit_profile')
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ route('user.profiles.show-change-password') }}">
                                        @lang('admin.navbar.change_password')
                                    </a>
                                </li>
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
