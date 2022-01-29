<ul class="header-breadcrumbs">
    @foreach (RamboBreadcrumbs::list() as $link => $label)
        <li>
            <a href="{{ $link }}">
                {{ $label }}
            </a>

            @if (! $loop->last)
                >
            @endif
        </li>
    @endforeach
</ul>
