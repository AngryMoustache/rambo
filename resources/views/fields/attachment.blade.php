<div class="{{ $field->wrapperClass }}">
    <x-rambo::label :field="$field" />

    <div class="{{ $field->inputWrapperClass }}">
        <livewire:rambo-attachment-picker :field="$field" />

        <x-rambo::error :field="$field" />
    </div>
</div>
