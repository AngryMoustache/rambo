<div class="nav">
    <a
        class="nav-logo"
        href="{{ route('rambo.dashboard') }}"
    >
        <x-rambo::logo />
    </a>

    <div class="nav-main">
        <div class="nav-main-logo">
            <a href="{{ route('rambo.dashboard') }}">
                R
            </a>
        </div>

        {{-- ICONS --}}
        <ul class="nav-main-list">
            <li>
                <a href="{{ route('rambo.dashboard') }}">
                    <i class="fas fa-home"></i>
                </a>
            </li>

            <li>
                <a href="/" target="_blank">
                    <i class="fas fa-globe"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('rambo.auth.logout') }}">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="nav-sub">
        {{-- RESOURCES --}}
        <ul class="nav-sub-list">
            @foreach (Rambo::navigation() as $key => $navItem)
                <x-rambo::navigation.navigation-item
                    :nav-item="$navItem"
                    :key="$key"
                    :depth="1"
                />
            @endforeach

            <li class="nav-sub-list-filler">
                <span></span>
            </li>
        </ul>
    </div>
</div>
