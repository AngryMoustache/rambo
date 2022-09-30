<x-rambo::modal>
    <x-slot name="title">Select an existing attachment</x-slot>

    <x-slot name="subtitle">
        <input type="text" wire:model="search" placeholder="Search for an attachment">
    </x-slot>

    <x-slot name="content">
        @if ($attachments->isNotEmpty())
            <div class="attachment-picker-grid">
                @foreach ($attachments as $attachment)
                    <div style="background-image: url('{{ $attachment->format('thumb') }}')"
                        wire:click="updateAttachment({{ $attachment->id }})"></div>
                @endforeach
            </div>
        @else
            <p>No attachments found with name "<strong>{{ $search }}</strong>."</p>
        @endif
    </x-slot>

    <x-slot name="preFooter">
        <div class="pagination">
            {{ $attachments->withQueryString()->links('rambo::components.crud.tables.pagination') }}
        </div>
    </x-slot>

    <x-slot name="footer">
        <a wire:click.prevent="closeModal" class="button-link">
            Cancel
        </a>
    </x-slot>
</x-rambo::modal>
