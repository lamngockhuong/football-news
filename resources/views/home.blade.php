@extends('layouts.app')
@section('content-title', 'Home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $userNumber }}</div>
                            <div>@lang('admin.dashboard.users')</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('users.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('admin.dashboard.view_details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $teamNumber }}</div>
                            <div>@lang('admin.dashboard.teams')</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('teams.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('admin.dashboard.view_details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-time fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $matchNumber }}</div>
                            <div>@lang('admin.dashboard.matches')</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('matches.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('admin.dashboard.view_details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-list-alt fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $betNumber }}</div>
                            <div>@lang('admin.dashboard.bets')</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('bets.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('admin.dashboard.view_details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
