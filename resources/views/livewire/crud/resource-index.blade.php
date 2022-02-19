<div class="card no-padding">
    <div class="crud-title">
        <h1 class="h3">{{ $resource->label() }}</h1>

        <div class="crud-title-actions">
            <ul class="crud-title-actions-list">
                @foreach ($resource->actions('index') as $key => $action)
                    <li class="crud-title-actions-list-item">
                        <livewire:is
                            :key="$key"
                            :component="$action->getLivewireComponent()"
                            :resource="$resource"
                            :action="$action"
                            label="true"
                        />
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @if (
        $resource->searchableFields()->isNotEmpty() ||
        $resource->getFilters()->isNotEmpty()
    )
        <div class="crud-index-search">
            @if ($resource->searchableFields()->isNotEmpty())
                <input
                    type="text"
                    wire:model.250ms="search"
                    wire:key="search_{{ $resource->routebase() }}"
                    placeholder="Search for {{ $resource->label() }}"
                >
            @endif

            @if ($resource->getFilters()->isNotEmpty())
                <div wire:click="toggleFilterModal" class="button">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                </div>
            @endif
        </div>
    @endif

    <div wire:loading.delay.long class="w-100">
        <x-rambo::loading />
    </div>

    <div wire:loading.delay.long.remove>
        @if ($items->isEmpty())
            <div class="crud-index-search">
                <p>No <strong>{{ $resource->label() }}</strong> found using the current filters.</p>
            </div>
        @endif

        @if ($items->isNotEmpty())
            @include($resource->indexTableBlade())
        @endif

        @if ($items->hasPages())
            <div class="pagination">
                {{ $items->withQueryString()->links('rambo::components.crud.tables.pagination') }}
            </div>
        @endif
    </div>
</div>
