<table class="crud-index-table">
    <thead>
        <tr>
            {{-- @foreach ($resource->fieldStack('index', true) as $field)
                <td>
                    @if ($field->sortable)
                        <span
                            class="crud-index-table-content crud-index-table-sortable"
                            wire:click="changeSort('{{ $field->getName() }}')"
                        >
                            {{ $field->getLabel() }}

                            @if ($sortCol === $field->getName())
                                @if ($sortDir === 'desc')
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
            @endforeach --}}
        </tr>
    </thead>

    {{-- <tbody wire:key="index_{{ $resource->routebase() }}">
        @foreach ($items as $item)
            <tr>
                @foreach ($resource->fieldStack('index', true) as $field)
                    <td>
                        <span class="crud-index-table-content">
                            {{ $field->item($item)->renderShow() }}
                        </span>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody> --}}
</table>
