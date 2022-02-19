<div class="action-wrapper">
    @if ($action->getCanSee() && ! $action->shouldHide($resource))
        <div class="action" wire:loading.remove>
            <a
                class="action-link action-icon"
                href="{{ $link }}"
                @if (! $link) wire:click.prevent="handle" @endif
            >
                @if (isset($label) && $label)
                    <span>{{ $action->getLabel() }}</span>
                @endif

                <i class="{{ $action->getIcon() }}"></i>
            </a>
        </div>

        <div class="action" wire:loading>
            <a class="button-loading action-link action-icon">
                <x-rambo::loading />
            </a>
        </div>
    @endif
</div>
