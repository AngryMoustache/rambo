@if ($value = $field->getShowValue())
    @foreach ($value as $item)
        <a href="/admin/attachments/{{ optional($item)->id }}">
            <img src="{{ optional($item)->format('thumb') }}">
        </a>
    @endforeach
@endif
