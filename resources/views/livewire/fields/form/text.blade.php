<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <input
            wire:model="value"
            type="{{ $field->type ?? 'text' }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            @if ($field->readonly || $field->disabled) disabled @endif
        >

        {{-- <x-rambo::crud.form.error :field="$field" /> --}}
    </div>
</div>
