@extends('light-bootstrap-dashboard::layouts.main')
@section('sidebar-menu')
    <ul class="nav">
        <li class="active">
            <a href="{{ route('home') }}">
                <i class="pe-7s-home"></i>
                <p>@lang('admin.sidebar_menu.home')</p>
            </a>
        </li>
    </ul>
@endsection
