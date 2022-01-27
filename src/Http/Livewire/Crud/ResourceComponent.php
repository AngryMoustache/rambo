<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class ResourceComponent extends RamboComponent
{
    public $resource;

    public function booted()
    {
        if (is_string($this->resource)) {
            $this->resource = Rambo::resource($this->resource, $this->itemId ?? null);
        }
    }

    public function dehydrate()
    {
        $this->resource = $this->resource->routebase();
    }
}
