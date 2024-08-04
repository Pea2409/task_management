@if ($paginator->hasPages())
    <div class="bg-pagination xlarge">
        <div class="pagination">
            <ul>
                @if ($paginator->onFirstPage())
                    <li class="pagination-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="pagination-link" aria-hidden="true">&lsaquo;&lsaquo; prev</span>
                    </li>
                @else
                    <li class="pagination-item">
                        <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="@lang('pagination.previous')">&lsaquo;&lsaquo; prev</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="pagination-item disabled" aria-disabled="true"><span
                                class="">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination-item active" aria-current="page"><span
                                        class="pagination-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="pagination-item">
                                    <a class="pagination-link"
                                        href="{{ isset($search) ? $search . '&page=' . $page : $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-item">
                        <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                            aria-label="@lang('pagination.next')">next &rsaquo;&rsaquo;</a>
                    </li>
                @else
                    <li class="pagination-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="pagination-link" aria-hidden="true">next &rsaquo;&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
