<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <title>@yield('title', trans('admin.title'))</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    @section('styles')
        {{ Html::style(mix('/css/light-bootstrap-dashboard.css')) }}
        {{ Html::style('templates/admin/css/bootstrap-datetimepicker.min.css') }}
    @show
    @stack('head')
</head>
<body>
    <div id="app" class="wrapper">
        @include('light-bootstrap-dashboard::layouts.sidebar.main')
        @include('light-bootstrap-dashboard::layouts.main-panel.main')
    </div>
    @section('scripts')
        {{ Html::script(mix('/js/manifest.js')) }}
        {{ Html::script(mix('/js/vendor.js')) }}
        {{ Html::script(mix('/js/light-bootstrap-dashboard.js')) }}
        {{ Html::script('templates/admin/js/moment.js') }}
        {{ Html::script('templates/admin/js/bootstrap-datetimepicker.min.js') }}
        {{ Html::script('templates/public/js/countdown.js') }}
        {{ Html::script('js/ckeditor/ckeditor.js') }}
    @show
    @stack('body')
</body>
</html>
