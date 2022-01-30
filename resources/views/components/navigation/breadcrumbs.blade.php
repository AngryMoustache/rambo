<ul class="header-breadcrumbs">
    @foreach (RamboBreadcrumbs::list() as $crumb)
        <li>
            <a href="{{ $crumb->queryLink }}">
                {{ $crumb->label }}
            </a>

            @if (! $loop->last)
                >
            @endif
        </li>
    @endforeach
</ul>
