<div class="action-wrapper">
    @if ($action->getCanSee() && ! $action->shouldHide())
        <div class="action">
            <a
                href="{{ $link }}"
                class="action-link action-icon"
                @if (! $link)
                    wire:click.prevent="handle"
                @endif
            >
                @if (isset($label) && $label)
                    <span>{{ $action->getLabel() }}</span>
                @endif

                <i class="{{ $action->getIcon() }}"></i>
            </a>
        </div>
    @endif
</div>
