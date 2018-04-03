@extends('light-bootstrap-dashboard::layouts.main')
@section('sidebar-menu')
    <ul class="nav">
        <li>
            <a href="{{ route('admin.home') }}">
                <i class="pe-7s-home"></i>
                <p>@lang('admin.sidebar_menu.dashboard')</p>
            </a>
        </li>
        <li>
            <a href="{{ route('countries.index') }}">
                <i class="pe-7s-map-2"></i>
                <p>@lang('admin.sidebar_menu.country')</p>
            </a>
        </li>
        <li>
            <a href="{{ route('leagues.index') }}">
                <i class="fa fa-futbol-o"></i>
                <p>@lang('admin.sidebar_menu.league')</p>
            </a>
        </li>
        <li>
            <a href="{{ route('teams.index') }}">
                <i class="pe-7s-flag"></i>
                <p>@lang('admin.sidebar_menu.team')</p>
            </a>
        </li>
        <li>
            <a href="{{ route('players.index') }}">
                <i class="pe-7s-users"></i>
                <p>@lang('admin.sidebar_menu.player')</p>
            </a>
        </li>
    </ul>
@endsection
