<div class="sidebar-wrapper">
    <div class="logo">
        @section('logo')
            <a href="#" class="simple-text">
                @lang('admin.title')
            </a>
        @show
    </div>

    @section('sidebar-menu')
        <ul class="nav">
            <li class="active">
                <a href="#">
                    <i class="pe-7s-home"></i>
                    <p>@lang('admin.sidebar_menu.home')</p>
                </a>
            </li>
        </ul>
    @show
</div>
