<div class="crud-form-field">
    <x-rambo::crud.fields.label :field="$field" />

    <div class="crud-form-field-input">
        <livewire:rambo-cropper :attachment="$item" />
    </div>
</div>
