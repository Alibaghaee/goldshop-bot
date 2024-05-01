@if ($paginator->hasPages())
    <ul class="flex flex-wrap list-reset justify-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="text-grey-dark bg-grey rounded ml-2 text-grey-darkest px-3" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="bg-grey rounded ml-2 text-grey-darkest">
                <a class="no-underline px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="text-grey-dark bg-grey rounded ml-2 text-grey-darkest" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="bg-green text-white rounded ml-2 text-grey-darkest px-3" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="bg-grey rounded ml-2 text-grey-darkest"><a class="no-underline px-3" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="bg-grey rounded ml-2 text-grey-darkest">
                <a class="no-underline px-3" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="text-grey-dark bg-grey rounded ml-2 text-grey-darkest px-3" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
