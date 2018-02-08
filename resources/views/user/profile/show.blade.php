@extends('layouts.app')
@section('title', trans('admin.profile.show.title'))
@section('content-title', trans('admin.user.index.title'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&amp;fm=jpg&amp;h=300&amp;q=75&amp;w=400"
                            alt="...">
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="{{ route('user.profiles.edit', ['id' => $user->id]) }}">
                                <img class="avatar border-gray" src="{{ $user->avatar_url }}"
                                    onerror='this.src="{{ asset('images/no-image.png') }}"' alt="...">
                                <h4 class="title">{{ $user->name }}</h4>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="header pull-left">
                        <h4 class="title">@lang('admin.profile.show.title')</h4>
                    </div>
                    @if (auth()->user()->id == $user->id)
                        <div class="header pull-right">
                            <div class="form-inline">
                                <a href="{{ route('user.profiles.edit', ['id' => $user->id]) }}" class="btn btn-fill btn-info btn-wd">
                                    @lang('admin.profile.show.edit_profile')
                                </a>
                                <a href="{{ route('user.profiles.show-change-password') }}" class="btn btn-fill btn-wd">
                                    @lang('admin.profile.show.change_password')
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped profile-table">

                            <tbody>
                                <tr>
                                    <td><i class="fa fa-user-o"></i> @lang('admin.profile.show.name')</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-envelope-o"></i> @lang('admin.profile.show.email')</td>
                                    <td>
                                        {{ $user->provider ? trans('admin.profile.show.social_user') : $user->email }}
                                        {{ $user->provider && $user->email ? "($user->email)" : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-bank"></i> @lang('admin.profile.show.coin')</td>
                                    <td>{{ $user->coin }}</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-heart-o"></i> @lang('admin.profile.show.status')</td>
                                    <td>
                                        {{ $user->is_actived ? trans('admin.profile.show.status_active') : trans('admin.profile.show.status_non_active') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-level-up"></i> @lang('admin.profile.show.level')</td>
                                    <td>
                                        {{ $user->is_admin ? trans('admin.profile.show.level_admin') : trans('admin.profile.show.level_member') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-calendar-o"></i> @lang('admin.profile.show.register_date')</td>
                                    <td>{{ $user->register_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (session('notification'))
            <div id="notify" data-message="{{ session('notification')['message'] }}" data-type="{{ session('notification')['type'] }}"></div>
        @endif
    </div>
@endsection
