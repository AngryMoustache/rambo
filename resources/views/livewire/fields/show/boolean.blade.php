<span>
    @if (in_array($value, [1, true]))
        <span
            class="tag"
            style="background: rgb(7, 187, 7); border: 0; cursor: pointer"
            wire:click="toggle(0)"
        >
            Yes
        </span>
    @else
        <span
            class="tag"
            style="background: rgb(187, 7, 7); border: 0; cursor: pointer"
            wire:click="toggle(1)"
        >
            No
        </span>
    @endif
</span>
