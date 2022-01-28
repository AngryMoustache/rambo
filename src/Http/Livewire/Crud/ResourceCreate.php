<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

class ResourceCreate extends ResourceFormComponent
{
    public function mount()
    {
        parent::mount();
        $this->component = $this->resource->createView();
    }
}
