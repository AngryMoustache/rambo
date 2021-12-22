<div class="crud-form-field">
    <div class="crud-form-field-label">
        <x-rambo::crud.form.label :field="$field" />
    </div>

    <div class="crud-form-field-input">
        <livewire:is
            :component="$field->livewireComponent"
            :key="$field->getName()"
            :field="$field"
            :emit="$field->emit"
        />

        <x-rambo::crud.form.error :field="$field" />
    </div>
</div>
