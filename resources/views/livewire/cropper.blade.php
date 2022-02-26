<div class="attachment-cropper" x-data="{ saveAsNew: false }">
    <div class="attachment-cropper-loading" wire:loading>
        <x-rambo::loading />
    </div>

    <div class="attachment-cropper-buttons">
        <select wire:model="current">
            <option value="">-</option>
            @foreach ($formats as $class => $format)
                <option value="{{ $class }}">
                    {{ $format }}
                </option>
            @endforeach
        </select>

        <button
            id="js-save-crop"
            class="button"
            @if (! $current) disabled @endif
            x-on:click="window.Livewire.emit('cropped', {
                crop: window.cropper.getCroppedCanvas().toDataURL(@js($attachment->mime_type)),
                data: window.cropper.getData(),
                saveAsNew: saveAsNew
            })"
        >
            Crop
        </button>

        <button
            id="js-reset-crop"
            class="button"
            @if (! $current) disabled @endif
            x-on:click="window.cropper.reset()"
        >
            Reset
        </button>
    </div>

    @if ($current)
        <div class="mt-1 crud-form-field-input crud-form-field-checkbox" style="width: 100%">
            <input
                type="checkbox"
                id="{{ $hash }}-save-as-new"
                name="{{ $hash }}-save-as-new"
                x-model="saveAsNew"
            >

            <label style="width: 80%" class="crud-form-field-label" for="{{ $hash }}-save-as-new">
                Save crop as new attachment
            </label>
        </div>
    @endif

    <div class="attachment-cropper-canvas">
        <img
            id="cropper"
            src="{{ $attachment->path() }}"
            wire:key="{{ $current }}"
        />
    </div>
</div>
