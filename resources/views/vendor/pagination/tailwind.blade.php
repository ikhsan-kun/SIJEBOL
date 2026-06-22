@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="jbl-pagination-container">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="jbl-page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="jbl-page-link" aria-hidden="true">&lsaquo;</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="jbl-page-item" aria-label="@lang('pagination.previous')">
                <span class="jbl-page-link">&lsaquo;</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="jbl-page-item disabled" aria-disabled="true">
                    <span class="jbl-page-link">{{ $element }}</span>
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="jbl-page-item active" aria-current="page">
                            <span class="jbl-page-link">{{ $page }}</span>
                        </span>
                    @else
                        <a href="{{ $url }}" class="jbl-page-item">
                            <span class="jbl-page-link">{{ $page }}</span>
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="jbl-page-item" aria-label="@lang('pagination.next')">
                <span class="jbl-page-link">&rsaquo;</span>
            </a>
        @else
            <span class="jbl-page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="jbl-page-link" aria-hidden="true">&rsaquo;</span>
            </span>
        @endif
    </nav>
@endif
