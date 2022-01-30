<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class ResourceIndex extends ResourceComponent
{
    use WithPagination;

    public $search = '';

    public $orderCol = '';
    public $orderDir = '';

    public $listeners = [
        'refresh',
    ];

    public $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        parent::mount();
        RamboBreadcrumbs::reset();
        RamboBreadcrumbs::add($this->resource->label());

        if (! $this->resource->can('index')) {
            return Rambo::unauthorized();
        }

        $this->component = $this->resource->indexView();
        $this->orderCol = request()->get('orderCol') ?? $this->resource->defaultOrderCol();
        $this->orderDir = request()->get('orderDir') ?? $this->resource->defaultOrderDir();
        $this->queryString['orderCol'] = ['except' => $this->resource->defaultOrderCol()];
        $this->queryString['orderDir'] = ['except' => $this->resource->defaultOrderDir()];
        $this->preLoad = $this->resource->preLoadIndex;
    }

    /** Fetch, search and filter the items and set them */
    public function refresh()
    {
        $this->addComponentData([
            'fieldStack' => $this->resource->fieldStack('index', true),
        ]);

        $items = $this->resource->indexQuery()
            ->orderBy($this->orderCol, $this->orderDir)
            ->get();

        /** Search the fields of the items */
        if ($this->search !== '') {
            $searchableFields = $this->resource->searchableFields();
            $items = $items->filter(function ($item) use ($searchableFields) {
                foreach ($searchableFields as $field) {
                    if ($field->search($this->search, $item)) {
                        return true;
                    }
                }

                return false;
            });
        }

        // Paginate at the end
        $pagination = $this->resource->pagination();
        $this->componentData['items'] = new LengthAwarePaginator(
            $items->forPage($this->page, $pagination),
            $items->count(),
            $pagination,
            $this->page
        );

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

    public function changeOrder($column)
    {
        if ($this->orderCol === $column) {
            $this->orderDir = ($this->orderDir === 'desc' ? 'asc' : 'desc');
        } else {
            $this->orderCol = $column;
            $this->orderDir = 'asc';
        }
    }
}
