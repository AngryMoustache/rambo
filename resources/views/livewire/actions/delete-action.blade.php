<div>
    <a href="#" wire:click.prevent="toggleModal" class="action-icon">
        <i class="{{ $action::$icon }}"></i>
    </a>

    @if ($modal)
        <x-rambo::modal>
            <x-slot name="title">
                Deleting: $name
            </x-slot>

            <x-slot name="content">
                Are you sure you wish to delete "$name?"
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
