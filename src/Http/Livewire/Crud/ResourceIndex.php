<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use Livewire\WithPagination;

class ResourceIndex extends ResourceComponent
{
    use WithPagination;

    public $component = 'rambo::livewire.crud.index';

    public $items;

    public $search = '';

    public $listeners = [
        'refresh' => 'updateData',
    ];

    public function render()
    {
        $this->updateData();
        return parent::render();
    }

    public function updateData()
    {
        $this->items = $this->resource->indexQuery()->get();
        $this->fillComponentData();

        /** Search the fields of the items */
        if ($this->search && $this->search !== '') {
            $searchableFields = $this->resource->searchableFields();
            $this->items = $this->items->filter(function ($item) use ($searchableFields) {
                foreach ($searchableFields as $field) {
                    if ($field->search($this->search, $item)) {
                        return true;
                    }
                }

                return false;
            });
        }
    }

    public function fillComponentData()
    {
        $this->componentData = [
            'fieldStack' => $this->resource->fieldStack('index', true),
        ];
    }
}
