<div class="habtm-picker-grid-panel">
    @if ($search === '' || $items->isNotEmpty())
        @foreach ($items as $item)
            @include($resource->habtmComponent(), [
                'resource' => $resource->item($item),
            ])
        @endforeach
    @else
        <p class="habtm-picker-grid-panel-empty">
            No {{ $resource }} found with name "<strong>{{ $search }}</strong>."
        </p>
    @endif
</div>
