<span
    class="habtm-picker-grid-panel-item"
    wire:click="toggleItem({{ $resource->itemId() }})"
>
    {{ $resource->itemName() }}
</span>
