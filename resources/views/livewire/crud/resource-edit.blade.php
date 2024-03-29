<div class="card no-padding">
    <div class="crud crud-create">
        <div class="crud-title">
            <h1 class="h3">Editing {{ $resource->singularLabel() }}</h1>

            <div class="crud-title-actions">
                <ul class="crud-title-actions-list">
                    @foreach ($resource->actions('edit') as $key => $action)
                        <li class="crud-title-actions-list-item">
                            <livewire:is
                                :key="$key"
                                :component="$action->getLivewireComponent()"
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

        <div wire:loading.flex wire:target="submit">
            <x-rambo::loading />
        </div>

        <div wire:loading.remove wire:target="submit">
            <div class="crud-form">
                @foreach ($resource->fieldStack('edit', $resource->item) as $field)
                    <x-rambo::crud.fields.form
                        :resource="$resource"
                        :field="$field"
                        :item="$resource->item"
                    />
                @endforeach
            </div>

            <div class="crud-form-button">
                @foreach ($resource->editButtons() as $button)
                    @include($button->getComponent())
                @endforeach
            </div>
        </div>
    </div>
</div>
