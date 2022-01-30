<div class="action-wrapper">
    @if (! $action->shouldHide($resource))
        <div class="action">
            <a href="{{ $link }}" class="action-link action-icon">
                @if (isset($label) && $label)
                    <span>{{ $action->label }}</span>
                @endif

                <i class="{{ $action->icon }}"></i>
            </a>
        </div>
    @endif
</div>
