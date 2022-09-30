@if ($field->getResource())
    @if ($value)
        <a class="inline-link" href="{{ $field->getLink() }}">
            {{ $value }}
        </a>
    @else
        -
    @endif
@else
    {{ $value ?? '-' }}
@endif
