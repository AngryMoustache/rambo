<div class="card no-padding">
    <div class="crud crud-show">
        <div class="crud-title">
            <h1 class="h3">{{ $resource->itemName() }}</h1>

            <div class="crud-title-actions">
                <ul class="crud-title-actions-list">
                    @foreach ($resource->actions('show') as $key => $action)
                        <li class="crud-title-actions-list-item">
                            <livewire:is
                                :key="$key"
                                :component="$action->getLivewireComponent()"
                                :resource="$resource"
                                :action="$action"
                                :item="$item"
                                label="true"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <table class="crud-show-table">
            @foreach ($resource->fieldStack('show', $item) as $field)
                <tr>
                    <td class="crud-show-table-label">
                        <span>
                            {{ $field->getLabel() }}
                        </span>
                    </td>

                    <td class="crud-show-table-value">
                        <x-rambo::crud.fields.show
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
