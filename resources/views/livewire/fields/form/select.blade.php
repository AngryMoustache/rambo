<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <select
            id="{{ $field->getName() }}"
            name="{{ $field->getName() }}"
            placeholder="{{ $field->getLabel() }}"
            wire:model.lazy="value"
        >
            @if ($field->isNullable())
                <option value="">-</option>
            @endif

            @foreach ($field->getOptions() as $key => $value)
                <option value="{{ $key }}">
                    {{ $value }}
                </option>
            @endforeach
        </select>

        <x-rambo::crud.fields.error :field="$field" />
    </div>
</div>
