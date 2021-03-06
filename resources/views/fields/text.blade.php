<div class="{{ $field->wrapperClass }}">
    <x-rambo::label :field="$field" />

    <div class="{{ $field->inputWrapperClass }}">
        <input
            class="{{ $field->inputClass }}"
            type="{{ $field->type ?? 'text' }}"
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            wire:model="fields.{{ $field->getName() }}"
            @if ($field->readonly || $field->disabled) disabled @endif
        >

        <x-rambo::error :field="$field" />
    </div>
</div>
