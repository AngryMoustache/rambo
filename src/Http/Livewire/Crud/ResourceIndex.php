<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use Livewire\WithPagination;

class ResourceIndex extends ResourceComponent
{
    use WithPagination;

    public $items;

    public $component = 'rambo::livewire.crud.index';

    public $listeners = [
        'refresh' => 'updateData',
    ];

    public function mount()
    {
        parent::mount();
        $this->updateData();
    }

    public function updateData()
    {
        $this->items = $this->resource->indexQuery()->get();
        $this->fillComponentData();
    }

    public function fillComponentData()
    {
        $this->componentData['fieldStack'] = $this->resource->fieldStack('index', true);
    }
}
