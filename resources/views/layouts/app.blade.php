@extends('light-bootstrap-dashboard::layouts.main')
@section('sidebar-menu')
    <ul class="nav">
        @if (auth()->user()->is_admin)
            <li>
                <a href="{{ route('admin.home') }}">
                    <i class="glyphicon glyphicon-home"></i>
                    <p>@lang('admin.sidebar_menu.dashboard')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('ranks.index') }}">
                    <i class="glyphicon glyphicon-stats"></i>
                    <p>@lang('admin.sidebar_menu.rank')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('bets.index') }}">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <p>@lang('admin.sidebar_menu.bet')</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-user"></i>
                    <p>@lang('admin.sidebar_menu.user')</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-th-list"></i>
                    <p>@lang('admin.sidebar_menu.category')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}">
                    <i class="glyphicon glyphicon-file"></i>
                    <p>@lang('admin.sidebar_menu.post')</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-comment"></i>
                    <p>@lang('admin.sidebar_menu.comment')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('countries.index') }}">
                    <i class="glyphicon glyphicon-flag"></i>
                    <p>@lang('admin.sidebar_menu.country')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('leagues.index') }}">
                    <i class="fa fa-trophy"></i>
                    <p>@lang('admin.sidebar_menu.league')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('matches.index') }}">
                    <i class="glyphicon glyphicon-time"></i>
                    <p>@lang('admin.sidebar_menu.match')</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-bullhorn"></i>
                    <p>@lang('admin.sidebar_menu.match_event')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('teams.index') }}">
                    <i class="fa fa-users"></i>
                    <p>@lang('admin.sidebar_menu.team')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('team-achievements.index') }}">
                    <i class="glyphicon glyphicon-certificate"></i>
                    <p>@lang('admin.sidebar_menu.team_achievement')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('positions.index') }}">
                    <i class="glyphicon glyphicon-screenshot"></i>
                    <p>@lang('admin.sidebar_menu.position')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('players.index') }}">
                    <i class="fa fa-futbol-o"></i>
                    <p>@lang('admin.sidebar_menu.player')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('player-awards.index') }}">
                    <i class="glyphicon glyphicon-gift"></i>
                    <p>@lang('admin.sidebar_menu.player_award')</p>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('user.home') }}">
                    <i class="glyphicon glyphicon-home"></i>
                    <p>@lang('admin.sidebar_menu.dashboard')</p>
                </a>
            </li>
            <li>
                <a href="{{ route('user.bets.index') }}">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <p>@lang('admin.sidebar_menu.bet')</p>
                </a>
            </li>
        @endif
    </ul>
@endsection
