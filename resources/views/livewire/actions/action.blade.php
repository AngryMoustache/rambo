<div class="action">
    <a href="{{ $link }}" class="action-link action-icon">
        @if (isset($label) && $label)
            <span>{{ $action->label }}</span>
        @endif

        <i class="{{ $action->icon }}"></i>
    </a>
</div>
