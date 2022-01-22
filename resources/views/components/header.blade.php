<div class="header">
    {{-- BREADCRUMBS --}}
    {{-- @isset($breadcrumbs)
        <ul class="header-breadcrumbs">
            @foreach ($breadcrumbs as $crumb)
                <li>
                    <a href="{{ $crumb['route'] }}">
                        {{ $crumb['label'] }}
                    </a>

                    @if (! $loop->last)
                        >
                    @endif
                </li>
            @endforeach
        </ul>
    @endisset --}}

    {{-- PROFILE --}}
    <div class="header-profile">
        <a href="{{ Rambo::user()->link() }}">
            @if (Rambo::user()->avatar)
                <img src="{{ Rambo::user()->avatar->format('thumb') }}">
            @endif
            <p>{{ Rambo::user()->username }}</p>
        </a>
    </div>
</div>
