<x-rambo::modal>
    <x-slot name="title">Upload a new attachment</x-slot>

    <x-slot name="content">
        <input id="upload" type="file" wire:model="uploadedFile">

        @if ($uploadedFile)
            <img src="{{ $uploadedFile->temporaryUrl() }}">
        @endif
    </x-slot>

    <x-slot name="footer">
        @if ($uploadedFile)
            <a wire:click.prevent="uploadImage" class="button">
                Upload attachment
            </a>
        @endif

        <a wire:click.prevent="closeModal" class="button-link">
            Cancel
        </a>
    </x-slot>
</x-rambo::modal>
