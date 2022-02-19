<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;
use AngryMoustache\Rambo\Filters\Filter;
use AngryMoustache\Rambo\Http\Livewire\Wireables\WiredRamboCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class ResourceIndex extends ResourceComponent
{
    use WithPagination;

    public $search = '';

    public $orderCol = '';
    public $orderDir = '';

    public WiredRamboCollection $filters;

    public $filterModal = true;

    public $listeners = [
        'refresh',
        'filters-updated' => 'filtersUpdated'
    ];

    public $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];


    private $items;

    public function mount()
    {
        RamboBreadcrumbs::reset();
        RamboBreadcrumbs::add($this->resource->label());
        if (! $this->resource->canViewIndex()) {
            return Rambo::unauthorized();
        }

        parent::mount();

        $this->component = $this->resource->indexView();
        $this->orderCol = request()->get('orderCol') ?? $this->resource->defaultOrderCol();
        $this->orderDir = request()->get('orderDir') ?? $this->resource->defaultOrderDir();
        $this->queryString['orderCol'] = ['except' => $this->resource->defaultOrderCol()];
        $this->queryString['orderDir'] = ['except' => $this->resource->defaultOrderDir()];
        $this->preLoad = $this->resource->preLoadIndex;
        $this->filters = WiredRamboCollection::wrap($this->resource->filters());
    }

    // Fetch, search and filter the items and set them
    public function refresh()
    {
        $this->addComponentData([
            'fieldStack' => $this->resource->flatFieldStack('index'),
        ]);

        // Get and parse data
        $items = $this->fetchInitialItems();
        $items = $this->parseSearch($items);
        $items = $this->parseFilters($items);

        // Paginate at the end
        $this->componentData['items'] = $this->buildPagination();

        // Go to page 1 if you are on a page with no items left
        if ($this->componentData['items']->count() === 0 && $this->page !== 1) {
            $this->page = 1;
            $this->refresh();
        }
    }

    public function render()
    {
        $this->refresh();
        return parent::render();
    }

    public function updatedSearch()
    {
        $this->page = 1;
    }

    public function toggleFilterModal()
    {
        $this->filterModal = ! $this->filterModal;
    }

    public function filtersUpdated($key, $enabled, $fields)
    {
        $this->filters[$key] = $this->filters[$key]
            ->enabled($enabled)
            ->fields($fields);
    }

    public function changeOrder($column)
    {
        if ($this->orderCol === $column) {
            $this->orderDir = ($this->orderDir === 'desc' ? 'asc' : 'desc');
        } else {
            $this->orderCol = $column;
            $this->orderDir = 'asc';
        }
    }

    protected function fetchInitialItems()
    {
        $this->items = $this->resource->indexQuery()
            ->orderBy($this->orderCol, $this->orderDir)
            ->get();

        return $this->items;
    }

    protected function parseSearch()
    {
        if ($this->search !== '') {
            $this->items = $this->items
                ->filter(fn ($item) => $this->resource->search($this->search, $item));
        }

        return $this->items;
    }

    protected function parseFilters()
    {
        foreach ($this->filters as $filter) {
            if ($filter->canBeSeen($this->resource) && $filter->isEnabled()) {
                $this->items = $this->items->filter(fn ($item) => $filter->handle(
                    $this->resource->item($item)
                ));
            }
        }

        return $this->items;
    }

    protected function buildPagination()
    {
        $pagination = $this->resource->pagination();
        return new LengthAwarePaginator(
            $this->items->forPage($this->page, $pagination),
            $this->items->count(),
            $pagination,
            $this->page
        );
    }
}
