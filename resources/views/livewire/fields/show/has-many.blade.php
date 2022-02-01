@if ($field->getShowValue()->isNotEmpty())
    <ul class="habtm-picker-list">
        @foreach ($field->getShowValue() as $item)
            <li>
                <a class="inline-link" href="{{ $field->getResource()->item($item)->show() }}">
                    {{ $field->getResource()->item($item)->itemName() }}
                </a>
            </li>
        @endforeach
    </ul>
@else
    <ul class="habtm-picker-list">
        <li>Nothing selected</li>
    </ul>
@endif
