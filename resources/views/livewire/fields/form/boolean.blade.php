<div class="crud-form-field">
    <div class="crud-form-field-label"></div>

    <div class="crud-form-field-input crud-form-field-checkbox">
        <input
            wire:model.lazy="value"
            type="checkbox"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            @if ($field->isReadonly() || $field->isDisabled()) disabled @endif
        >

        <x-rambo::crud.fields.label :field="$field" />
        <x-rambo::crud.fields.error :field="$field" />
    </div>
</div>
