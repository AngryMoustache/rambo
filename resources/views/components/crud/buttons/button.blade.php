@if ($button->canBeSeen($resource))
    <div class="crud-form-button-input">
        <input
            type="button"
            wire:click.prevent="{{ $button->getAction() }}"
            value="{{ $button->getLabel() }}"
            @class([
                'button-link' => $button->isInline(),
                'button',
                'ml-1',
            ])
        >
    </div>
@endif
