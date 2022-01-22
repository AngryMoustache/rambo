<li>
    @if (is_array($resource))
        <input
            type="checkbox"
            id="sub-{{ $key }}"
            {{-- @if (($navigation['pathToActive'][$depth - 1] ?? null) === $key)
                checked
            @endif --}}
        >

        <div class="nav-sub-list-sub">
            <label class="pl-{{ $depth }}" for="sub-{{ $key }}">
                <i class="far fa-folder"></i>
                <i class="far fa-folder-open"></i>
                {{ $key }}
            </label>

            <ul>
                @php $depth += 1 @endphp
                @php $_resource = $resource @endphp
                @foreach ($_resource as $key => $resource)
                    <x-rambo::navigation.navigation-item
                        :resource="$resource"
                        :key="$key"
                        :depth="$depth"
                    />
                @endforeach
            </ul>
        </div>
    @else
        <a
            href="{{ $resource->index() }}"
            class="@if ($resource->isActive()) active @endif pl-{{ $depth }}"
        >
            {{ $resource->label() }}
        </a>
    @endif
</li>
