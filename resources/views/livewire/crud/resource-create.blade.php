<div class="card no-padding">
    <div class="crud crud-create">
        <div class="crud-title">
            <h1 class="h3">Creating {{ $resource->singularLabel() }}</h1>

            <div class="crud-title-actions">
                <ul class="crud-title-actions-list">
                    @foreach ($resource->actions('create') as $key => $action)
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

        <div wire:loading.flex wire:target="submit">
            <x-rambo::loading />
        </div>

        <div wire:loading.remove wire:target="submit">
            @foreach ($resource->fieldStack('create') as $field)
                <livewire:is
                    :key="$field->getName()"
                    :component="$field->getLivewireFormComponent()"
                    :resource="$resource"
                    :field="$field"
                />
            @endforeach
        </div>

        <div class="crud-form-button">
            @foreach ($resource->buttons('create') as $button)
                @include($button::$component)
            @endforeach
        </div>
    </div>
</div>
