<div class="crud-form-button-input">
    <input
        type="button"
        wire:click.prevent="{{ $button::$action }}"
        value="{{ $button::$label }}"
        @class([
            'button-link' => $button::$inline,
            'button',
            'ml-1',
        ])
    >
</div>
