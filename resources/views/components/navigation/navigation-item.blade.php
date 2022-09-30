<li>
    @if (is_array($navItem['resource']))
        <input
            type="checkbox"
            id="sub-{{ $key }}"
            @if ($navItem['active']) checked @endif
        >

        <div class="nav-sub-list-sub">
            <label class="pl-{{ $depth }}" for="sub-{{ $key }}">
                <i class="far fa-folder"></i>
                <i class="far fa-folder-open"></i>
                {{ $key }}
            </label>

            <ul>
                @php $depth += 1 @endphp
                @php $_resource = $navItem['resource'] @endphp
                @foreach ($_resource as $key => $item)
                    <x-rambo::navigation.navigation-item
                        :nav-item="$item"
                        :key="$key"
                        :depth="$depth"
                    />
                @endforeach
            </ul>
        </div>
    @else
        <a
            href="{{ $navItem['resource']->index() }}"
            class="@if ($navItem['active']) js-nav-active active @endif pl-{{ $depth }}"
        >
            {{ $navItem['resource']->label() }}
        </a>
    @endif
</li>
