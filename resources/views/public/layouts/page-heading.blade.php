@section('page-heading')
    <!-- Page Heading & Breadcrumbs  -->
    <div class="page-heading-breadcrumbs">
        <div class="container">
            <h2>{{ $page_title }}</h2>
            <ul class="breadcrumbs">
                <li><a href="{{ route('home') }}">@lang('public.home')</a></li>
                <li>{{ $page_title_breadcrumbs }}</li>
            </ul>
        </div>
    </div>
    <!-- Page Heading & Breadcrumbs  -->
@show
