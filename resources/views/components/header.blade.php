<div class="header">
    {{-- GLOBAL SEARCH --}}
    <livewire:rambo-global-search />

    {{-- BREADCRUMBS --}}
    <x-rambo::navigation.breadcrumbs />

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
