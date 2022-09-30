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
        @include($resource->indexTableBlade())
    </div>

    @if ($filterModal)
        <x-rambo::modal :loader="false">
            <x-slot name="title">{{ $resource->singularLabel() }} filters</x-slot>

            <x-slot name="content" class="no-padding">
                @foreach ($filters as $key => $filter)
                    <livewire:rambo-filter-component
                        :filter-key="$key"
                        :filter="$filter"
                        :resource="$resource"
                        wire:key="filter_{{ $key }}"
                    />
                @endforeach
            </x-slot>

            <x-slot name="footer">
                <a wire:click.prevent="toggleFilterModal" class="button-link">
                    Close
                </a>
            </x-slot>
        </x-rambo::modal>
    @endif
</div>
