<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

class ResourceShow extends ResourceComponent
{
    public function mount()
    {
        parent::mount();
        $this->component = $this->resource->showView();
    }

    public function getComponentData()
    {
        return array_merge([
            'item' => $this->resource->item(),
        ], $this->componentData);
    }
}
