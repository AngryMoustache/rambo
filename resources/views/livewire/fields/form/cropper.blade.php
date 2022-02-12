<div class="crud-form-field">
    <div class="flex">
        <div wire:loading>
            <x-rambo::loading />
        </div>

        <div class="w-25">
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
                @if (! $current) disabled @endif
            >
                Save
            </button>

            <button
                id="js-reset-crop"
                @if (! $current) disabled @endif
            >
                Reset
            </button>
        </div>

        <div class="w-75">
            @if ($current)
                <img
                    id="cropper"
                    src="{{ $item->path() }}"
                    style="display: block; max-width: 100%"
                    wire:key="{{ $current }}"
                />
            @endif
        </div>
    </div>
</div>

@once('rambo-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.js"></script>
    <script>
        // Triggered from Livewire when selecting
        window.addEventListener('load-cropper', (e, one, two) => {
            const $img = document.getElementById('cropper')
            window.cropper = new Cropper($img, {
                ...e.detail.options,
                viewMode: 1,
                dragMode: 'move',
                ready () {
                    this.cropper.setData(e.detail.initial)
                }
            })
        })

        const $save = document.getElementById('js-save-crop')
        $save.addEventListener('click', (e) => {
            const crop = window.cropper.getCroppedCanvas().toDataURL(@json($item->mime_type))
            window.Livewire.emit('cropped', {
                crop: crop,
                data: window.cropper.getData(),
            })
        })

        const $reset = document.getElementById('js-reset-crop')
        $reset.addEventListener('click', (e) => window.cropper.reset())
    </script>
@endonce

@once('rambo-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.css" />
@endonce
