@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="pagination-holder">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a class="disabled">
                        <span><i class="fa fa-angle-double-left"></i>@lang('public.pagination.previous')</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-double-left"></i>@lang('public.pagination.previous')
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a ><span>{{ $page }}</span></a></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li><a class="disabled"><i class="fa fa-ellipsis-h"></i></a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        @lang('public.pagination.next')<i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <a class="disabled">
                        <span>@lang('public.pagination.next')<i class="fa fa-angle-double-right"></i></span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
