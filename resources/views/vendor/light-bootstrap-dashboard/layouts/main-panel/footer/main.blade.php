<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            @section('footer-menu')
            <ul>
                <li>
                    <a href="#">
                        @lang('admin.footer_menu.home')
                    </a>
                </li>
            </ul>
            @show
        </nav>
        <p class="copyright pull-right">
            &copy; {{ date('Y') }}
        </p>
    </div>
</footer>
