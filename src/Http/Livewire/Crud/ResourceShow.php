<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceShow extends ResourceComponent
{
    public function mount()
    {
        parent::mount();
        RamboBreadcrumbs::add($this->resource->itemName());
        $this->component = $this->resource->showView();
    }

    public function getComponentData()
    {
        return array_merge([
            'item' => $this->resource->item,
        ], $this->componentData);
    }
}
