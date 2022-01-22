<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class ResourceComponent extends RamboComponent
{
    public $resource;

    public function hydrate()
    {
        $this->resource = Rambo::resource($this->resource);
    }

    public function dehydrate()
    {
        $this->resource = $this->resource->routebase();
    }
}
