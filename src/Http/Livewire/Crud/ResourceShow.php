<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceShow extends ResourceComponent
{
    public function booted()
    {
        parent::booted();
        RamboBreadcrumbs::add($this->resource->itemName());
    }

    public function mount()
    {
        parent::mount();
        $this->component = $this->resource->showView();
    }

    public function getComponentData()
    {
        return array_merge([
            'item' => $this->resource->item,
        ], $this->componentData);
    }
}
