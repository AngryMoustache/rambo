<div class="action">
    <a href="#" wire:click.prevent="toggleModal" class="action-link action-icon">
        @if (isset($label) && $label)
            <span>{{ $action->label }}</span>
        @endif

        <i class="{{ $action->icon }}"></i>
    </a>

    @if ($modal)
        <x-rambo::modal>
            <x-slot name="title">
                Deleting: {{ $item->{$resource->displayName()} }}
            </x-slot>

            <x-slot name="content">
                Are you sure you wish to delete "{{ $item->{$resource->displayName()} }}"
            </x-slot>

            <x-slot name="footer">
                <a wire:click.prevent="deleteConfirm" class="button">
                    Delete
                </a>

                <a wire:click.prevent="toggleModal" class="button-link">
                    Cancel
                </a>
            </x-slot>
        </x-rambo::modal>
    @endif
</div>
