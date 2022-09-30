@if ($paginator->hasPages())
    <div class="pagination-text">
        <p>
            Showing <strong>{{ $paginator->firstItem() }}</strong>
            to <strong>{{ $paginator->lastItem() }}</strong>
            of <strong>{{ $paginator->total() }}</strong>
            results
        </p>
    </div>

    <div class="pagination-links">
        <div class="pagination-links-item">
            @if ($paginator->onFirstPage())
                <span
                    wire:key="previousInactive"
                    class="pagination-links-item-inactive"
                >
                    <
                </span>
            @else
                <span
                    wire:key="previousActive"
                    wire:click="previousPage"
                >
                    <
                </span>
            @endif
        </div>

        @foreach ($elements as $element)
            @if (is_string($element))
                <div class="pagination-links-item">
                    <span class="pagination-links-item-inactive">
                        {{ $element }}
                    </span>
                </div>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <div
                        class="pagination-links-item"
                        wire:key="paginator-page{{ $page }}"
                    >
                        @if ($page == $paginator->currentPage())
                            <span
                                wire:key="paginator-page{{ $page }}-inactive"
                                class="pagination-links-item-active"
                            >
                                {{ $page }}
                            </span>
                        @else
                            <span
                                wire:key="paginator-page{{ $page }}-active"
                                wire:click="gotoPage({{ $page }})"
                            >
                                {{ $page }}
                            </span>
                        @endif
                    </div>
                @endforeach
            @endif
        @endforeach

        <div class="pagination-links-item">
            @if (! $paginator->hasMorePages())
                <span
                    wire:key="nextInactive"
                    class="pagination-links-item-inactive"
                >
                    >
                </span>
            @else
                <span
                    wire:key="nextActive"
                    wire:click="nextPage"
                >
                    >
                </span>
            @endif
        </div>
    </div>
@endif
