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

    @if ($resource->searchableFields()->isNotEmpty())
        <div class="crud-index-search">
            <input
                type="text"
                wire:key="seach_{{ $resource->routebase() }}"
                wire:model.250ms="search"
                placeholder="Search for {{ $resource->label() }}"
            >
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
