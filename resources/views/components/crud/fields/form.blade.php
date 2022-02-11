@if ($field->getLivewireFormComponent())
    <livewire:is
        :key="$field->getName()"
        :component="$field->getLivewireFormComponent()"
        :resource="$resource"
        :field="$field"
        :item="$resource->item"
        :rules="$field->getRules()"
    />
@else
    @include($field->getBladeFormComponent(), [
        'value' => $field->getFormValue(),
    ])
@endif
