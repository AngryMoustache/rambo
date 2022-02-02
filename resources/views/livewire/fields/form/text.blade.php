<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <input
            wire:model.lazy="value"
            type="{{ $field->getType() ?? 'text' }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            @if ($field->isReadonly() || $field->isDisabled()) disabled @endif
        >

        <x-rambo::crud.fields.error :field="$field" />
    </div>
</div>
