@if ($value = $field->getShowValue())
    <a href="/admin/attachments/{{ optional($value)->id }}">
        <img src="{{ optional($value)->format('thumb') }}">
    </a>
@endif
