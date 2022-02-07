<span
    class="habtm-picker-grid-panel-item"
    wire:click="toggleItem({{ $resource->itemId() }})"
    style="
        background-image: url({{ $resource->item->format('thumb') }});
        background-size: cover;
        background-position: center;
        width: 30%;
        padding: 30% 0 0;
        margin: 1.665%;
        float: left;
    "
></span>
