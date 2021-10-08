<div class="crud-form-field">
    <div class="crud-form-field-label">
        <x-rambo::crud.form.label :field="$field" />
    </div>

    <div class="crud-form-field-input crud-form-field-checkbox">
        <input
            type="checkbox"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            wire:model="{{ $field->getBindingName() }}"
            @if ($field->readonly || $field->disabled) disabled @endif
        >

        <x-rambo::crud.form.error :field="$field" />
    </div>
</div>
