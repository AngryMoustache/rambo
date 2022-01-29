<table class="crud-index-table">
    <thead>
        <tr>
            @foreach ($resource->fieldStack('index') as $field)
                <td>
                    @if ($field->isSortable())
                        <span
                            class="crud-index-table-content crud-index-table-sortable"
                            wire:click="changeOrder('{{ $field->getName() }}')"
                        >
                            {{ $field->getLabel() }}

                            @if ($orderCol === $field->getName())
                                @if ($orderDir === 'desc')
                                    <i class="fas fa-sort-down"></i>
                                @else
                                    <i class="fas fa-sort-up"></i>
                                @endif
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </span>
                    @else
                        <span class="crud-index-table-content">
                            {{ $field->getLabel() }}
                        </span>
                    @endif
                </td>
            @endforeach
            <td colspan="{{ count($resource->actions('table')) }}"></td>
        </tr>
    </thead>

    <tbody wire:key="index_{{ $resource->routebase() }}">
        @foreach ($items as $item)
            <tr>
                @foreach ($resource->fieldStack('index') as $field)
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

                @foreach ($resource->actions('table') as $key => $action)
                    <td class="crud-index-table-action">
                        <livewire:is
                            :key="$key . '_' . $item->id"
                            :component="$action->getLivewireComponent()"
                            :resource="$resource->item($item)"
                            :action="$action"
                            :item="$item"
                        />
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
