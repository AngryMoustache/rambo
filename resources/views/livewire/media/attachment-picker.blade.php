<div class="attachment-picker">
    @if ($value)
        <div class="attachment-picker-selection">
            <img src="{{ $value->format('thumb') }}">
            <i
                wire:click="clearSelection"
                class="button fa fa-trash"
            ></i>
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
</div>
