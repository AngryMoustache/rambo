<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <livewire:rambo-attachment-picker
            :field="$field"
            :value="$value"
        />

        <x-rambo::crud.fields.error :field="$field" />
    </div>
</div>
