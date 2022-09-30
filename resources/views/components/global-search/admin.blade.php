<li>
    <a href="{{ $resource->show() }}">
        @if ($resource->item->avatar)
            <img src="{{ $resource->item->avatar->format('thumb') }}">
        @endif

        {{ $resource->itemName() }}
    </a>
</li>
