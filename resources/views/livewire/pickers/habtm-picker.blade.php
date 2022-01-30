<div class="habtm-picker">
    @if ($selectedItems->isNotEmpty())
        <ul class="habtm-picker-list">
            @foreach ($selectedItems as $item)
                <li>{{ $resource->item($item)->itemName() }}</li>
            @endforeach
        </ul>
    @else
        <ul class="habtm-picker-list">
            <li>Nothing selected</li>
        </ul>
    @endif

    <a wire:click.prevent="toggleModal" class="button">
        Add/Remove {{ $resource->label() }}
    </a>

    @if ($selecting)
        <x-rambo::modals.habtm-picker-selecting
            :search="$search"
            :resource="$resource"
            :selected-items="$selectedItems"
            :unselected-items="$unselectedItems"
        />
    @endif
</div>
