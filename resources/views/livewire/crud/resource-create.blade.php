<div class="card no-padding">
    <div class="crud crud-create">
        <div class="crud-title">
            <h1 class="h3">Creating {{ $resource->singularLabel() }}</h1>

            <div class="crud-title-actions">
                <ul>
                    @foreach ($resource->actions('create') as $action)
                        <li>
                            {{-- {{ (new $action($resource, $currentUrl))->render() }} --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="crud-form">
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
