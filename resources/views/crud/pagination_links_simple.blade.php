@if ($paginator->hasPages())
    <div class="uk-margin-top uk-margin-bottom">
    <ul class="uk-pagination uk-flex-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="uk-disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
        @else
            <li class="uk-active"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="uk-active"><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="uk-disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
    </div>
@endif
