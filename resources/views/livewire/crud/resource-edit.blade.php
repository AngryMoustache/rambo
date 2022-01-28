<div class="card no-padding">
    <div class="crud crud-create">
        <div class="crud-title">
            <h1 class="h3">Editing {{ $resource->singularLabel() }}</h1>

            <div class="crud-title-actions">
                <ul class="crud-title-actions-list">
                    @foreach ($resource->actions('edit') as $action)
                        <li class="crud-title-actions-list-item">
                            <livewire:is
                                :key="$action . '_' . $resource->item->id"
                                :component="$action::getLivewireComponent()"
                                :resource="$resource"
                                :action="$action"
                                :item="$resource->item"
                                label="true"
                            />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div wire:loading.flex>
            <x-rambo::loading />
        </div>

        <div wire:loading.remove>
            <div class="crud-form">
                @foreach ($resource->fieldStack('edit') as $field)
                    <livewire:is
                        :key="$field->getName()"
                        :component="$field->getLivewireFormComponent()"
                        :resource="$resource"
                        :field="$field"
                        :item="$resource->item"
                    />
                @endforeach
            </div>

            <div class="crud-form-button">
                @foreach ($resource->buttons('edit') as $button)
                    @include($button::$component)
                @endforeach
            </div>
        </div>
    </div>
</div>
