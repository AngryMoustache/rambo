<div class="crud-form-button-input">
    <input
        type="button"
        class="button ml-1"
        wire:click.prevent="{{ $button::$action }}"
        value="{{ $button::$label }}"
    >
</div>
