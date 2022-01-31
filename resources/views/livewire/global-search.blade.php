<div class="global-search">
    <input
        type="text"
        wire:model.delay="query"
        placeholder="Search CMS"
        id="global-search"
    >

    @if ($query !== '')
        <div class="global-search-results">
            <div class="global-search-results-lists">
                <div wire:loading.flex wire:target="updatedQuery">
                    <x-rambo::loading />
                </div>

                <div wire:loading.remove wire:target="updatedQuery">
                    @if ($results->isNotEmpty())
                        <ul>
                            @foreach ($results as $group)
                                <li>
                                    <span class="global-search-results-lists-label">
                                        {{ $group->label }}
                                    </span>
                                    <ul class="global-search-results-lists-items">
                                        @foreach ($group->resources as $resource)
                                            @include($resource->globalSearchBladeComponent())
                                        @endforeach

                                        @if ($group->count > $group->resources->count())
                                            <li>
                                                <a
                                                    class="inline-link"
                                                    href="{{ $resource->index() }}?search={{ $query }}"
                                                >
                                                    Other
                                                    {{ $resource->label() }}
                                                    ({{ $group->count }})
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="global-search-results-lists-empty">
                            Nothing found.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <script>
        let input = document.getElementById('global-search');
        input.addEventListener('blur', () => {
            @this.query = '';
        });
    </script>
</div>
