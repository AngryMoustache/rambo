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
                @include($field->getShowWrapperComponent())
            @endforeach
        </table>
    </div>
</div>
