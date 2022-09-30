<div class="attachment-picker">
    @if ($value)
        <div
            class="attachment-picker-selection"
            style="background-image: url('{{ $value->format('thumb') }}')"
        >
            <i
                wire:click="clearSelection"
                class="button fa fa-trash"
            ></i>

            @if (Rambo::cropperEnabled())
                <i
                    wire:click="openCroppingModal"
                    class="button fas fa-crop"
                ></i>
            @endif
        </div>
    @else
        <div class="attachment-picker-actions">
            <a class="button" wire:click.prevent="openSelectModal">
                <i class="far fa-images mr-1"></i>
                Select
            </a>

            <a class="button" wire:click.prevent="openUploadModal">
                <i class="fas fa-upload mr-1"></i>
                Upload
            </a>
        </div>
    @endif

    @if ($selecting)
        <x-rambo::modals.attachment-picker.selecting
            :attachments="$attachments"
            :search="$search"
        />
    @endif

    @if ($uploading)
        <x-rambo::modals.attachment-picker.uploading
            :uploaded-file="$uploadedFile"
        />
    @endif

    @if ($cropping)
        <x-rambo::modals.attachment-picker.cropping
            :attachment="$value"
        />
    @endif
</div>
