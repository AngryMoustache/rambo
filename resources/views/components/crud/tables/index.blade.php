<table class="crud-index-table">
    <thead>
        <tr>
            @foreach ($fieldStack as $field)
                <td>
                    @if ($field->sortable)
                        <span
                            class="crud-index-table-content crud-index-table-sortable"
                            wire:click="changeSort('{{ $field->getName() }}')"
                        >
                            {{ $field->getLabel() }}

                            {{-- @if ($sortCol === $field->getName())
                                @if ($sortDir === 'desc')
                                    <i class="fas fa-sort-down"></i>
                                @else
                                    <i class="fas fa-sort-up"></i>
                                @endif
                            @else
                                <i class="fas fa-sort"></i>
                            @endif --}}
                        </span>
                    @else
                        <span class="crud-index-table-content">
                            {{ $field->getLabel() }}
                        </span>
                    @endif
                </td>
            @endforeach
            <td colspan="{{ count($resource->itemActions()) }}"></td>
        </tr>
    </thead>

    <tbody wire:key="index_{{ $resource->routebase() }}">
        @foreach ($items as $item)
            <tr>
                @foreach ($fieldStack as $field)
                    <td>
                        <span class="crud-index-table-content">
                            <livewire:is
                                :key="$field->getName() . '_' . $item->id"
                                :component="$field->getLivewireShowComponent()"
                                :resource="$resource"
                                :field="$field"
                                :item="$item"
                            />
                        </span>
                    </td>
                @endforeach

                @foreach ($resource->itemActions() as $action)
                    <td class="crud-index-table-action">
                        <livewire:is
                            :key="$action . '_' . $item->id"
                            :component="$action::getLivewireComponent()"
                            :resource="$resource"
                            :action="$action"
                            :item="$item"
                        />
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>