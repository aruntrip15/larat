@if ($paginator->hasPages())
    <nav style="float:right">
        <ul class="pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <a href="javascript:void(0);">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><a href="javascript:void(0);">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="javascript:void(0);" class="bg-{{config('settings.adminTheme')}}">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}" class="waves-effect">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="waves-effect">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            @endif
            
        </ul>
    </nav>
@endif
