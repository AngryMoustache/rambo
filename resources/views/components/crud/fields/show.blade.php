@if ($field->getLivewireShowComponent())
    <livewire:is
        :key="$field->getName() . '_' . $item->id"
        :component="$field->getLivewireShowComponent()"
        :resource="$resource"
        :field="$field"
        :item="$item"
    />
@else
    @include($field->getBladeShowComponent(), [
        'value' => $field->getShowValue(),
    ])
@endif
