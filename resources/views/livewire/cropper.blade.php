<div class="attachment-cropper">
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
            x-data="{}"
            x-on:click="window.Livewire.emit('cropped', {
                crop: window.cropper.getCroppedCanvas().toDataURL(@js($attachment->mime_type)),
                data: window.cropper.getData(),
            })"
        >
            Save
        </button>

        <button
            id="js-reset-crop"
            class="button"
            @if (! $current) disabled @endif
            x-data="{}"
            x-on:click="window.cropper.reset()"
        >
            Reset
        </button>
    </div>

    <div class="attachment-cropper-canvas">
        <img
            id="cropper"
            src="{{ $attachment->path() }}"
            wire:key="{{ $current }}"
        />
    </div>
</div>
