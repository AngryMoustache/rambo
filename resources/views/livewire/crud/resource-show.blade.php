<div class="card no-padding">
    <div class="crud crud-show">
        <div class="crud-title">
            <h1 class="h3">{{ $resource->itemName() }}</h1>

            <div class="crud-title-actions">
                {{-- <ul>
                    @foreach ($resource->showActions() as $action)
                        <li>
                            {{ (new $action($resource, $currentUrl, $item))->render() }}
                        </li>
                    @endforeach
                </ul> --}}
            </div>
        </div>

        <table class="crud-show-table">
            @foreach ($resource->fieldStack('show') as $field)
                <tr>
                    <td class="crud-show-table-label">
                        <span>
                            {{ $field->getLabel() }}
                        </span>
                    </td>

                    <td class="crud-show-table-value">
                        <livewire:is
                            :key="$field->getName() . '_' . $item->id"
                            :component="$field->getLivewireShowComponent()"
                            :resource="$resource"
                            :field="$field"
                            :item="$item"
                        />
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
