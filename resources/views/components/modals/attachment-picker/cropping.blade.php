<x-rambo::modal :loader="false">
    <x-slot name="title">Cropper</x-slot>

    <x-slot name="content" :fixed="true">
        <div class="attachment-cropper-modal">
            <livewire:rambo-cropper :attachment="$attachment" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <a wire:click.prevent="closeModal" class="button-link">
            Finish cropping
        </a>
    </x-slot>
</x-rambo::modal>
