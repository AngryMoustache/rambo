<div class="action-wrapper">
    @if ($action->canBeSeen($resource))
        <div class="action">
            <a href="#" wire:click.prevent="toggleModal" class="action-link action-icon">
                @if (isset($label) && $label)
                    <span>{{ $action->getLabel() }}</span>
                @endif

                <i class="{{ $action->getIcon() }}"></i>
            </a>

            @if ($modal)
                <x-rambo::modal>
                    <x-slot name="title">
                        Deleting: {{ $resource->itemName() }}
                    </x-slot>

                    <x-slot name="content">
                        Are you sure you wish to delete "{{ $resource->itemName() }}"
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
    @endif
</div>
