<!-- Shop Pagination Area -->
@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <a href="javascript:;" class="next prev page-numbers">
            <i
                class='bx bx-left-arrow-alt prev-icon'>
            </i>
            <span>Prev</span>
        </a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="prev page-numbers">
            <i
                class='bx bx-left-arrow-alt prev-icon'>
            </i>
            <span>Prev</span>
        </a>
    @endif



    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        <div class="d-flex align-items-center">     
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current" aria-current="page">{{$page}}</span>
                    @else
                        <a href="{{ $url }}" class="page-numbers">{{$page}}</a>
                    @endif
                @endforeach
            @endif
        </div>
    @endforeach
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="prev page-numbers">
            <span>Next</span>
            <i class='bx bx-right-arrow-alt next-icon'></i>
        </a>
    @else
        <a href="javascript" class="next page-numbers">
            <span>Next</span>
            <i class='bx bx-right-arrow-alt next-icon'></i>
        </a>
    @endif
@endif
