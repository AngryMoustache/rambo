<div class="card no-padding">
    <div class="crud-title">
        <h1 class="h3">{{ $resource->label() }}</h1>

        <div class="crud-title-actions">
        </div>
    </div>

    <div wire:loading.delay class="w-100">
        <x-rambo::loading />
    </div>

    <div wire:loading.delay.remove>
        {{-- @if ($items->isEmpty())
            <div class="crud-index-search">
                <p>No <strong>{{ $resource->getLabel() }}</strong> found using the current filters.</p>
            </div>
        @endif --}}

        @if ($items->isNotEmpty())
            @include($resource->indexTableView())
        @endif

        {{-- @if ($items->hasPages())
            <div class="pagination">
                {{ $items->withQueryString()->links('rambo::components.crud.index.pagination') }}
            </div>
        @endif --}}
    </div>
</div>
