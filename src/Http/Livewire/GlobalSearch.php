<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Resource;

class GlobalSearch extends RamboComponent
{
    public $component = 'rambo::livewire.global-search';

    public $query = '';

    private $results;

    public function mount()
    {
        $this->updatedQuery();
    }

    public function updatedQuery()
    {
        $this->results = collect();

        Rambo::resources()->each(function (Resource $resource) {
            if (! $resource->isGlobalSearchable()) {
                return;
            }

            if ($resource->searchableFields()->isEmpty()) {
                return;
            }

            $items = $resource->globalSearchQuery()->get();
            if ($items->isEmpty()) {
                return;
            }

            $items = $items
                ->filter(fn ($item) => $resource->search($this->query, $item))
                ->map(fn ($item) => clone $resource->item($item));

            if ($items->isNotEmpty()) {
                $this->results[$resource->routebase()] = (object) [
                    'resource' => $resource,
                    'label' => $resource->globalSearchLabel(),
                    'weight' => $resource->globalSearchWeight() ?? $items->count(),
                    'count' => $items->count(),
                    'resources' => $items->take($resource->globalSearchPagination()),
                ];
            }
        });

        $this->results = $this->results->sortByDesc('weight');
        $this->addComponentData(['results' => $this->results]);
    }
}
