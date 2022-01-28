<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Exceptions\RamboNotFoundHttpException;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class ResourceComponent extends RamboComponent
{
    public $resource;
    public $itemId;

    public function mount()
    {
        parent::mount();
        if (! $this->resource) {
            $this->handleResourceNotFound();
        }

        if (! optional($this->resource)->item && $this->itemId) {
            $this->handleResourceNotFound();
        }
    }

    public function hydrate()
    {
        parent::hydrate();
        if (is_string($this->resource)) {
            $this->resource = Rambo::resource($this->resource, $this->itemId ?? null);
        }
    }

    public function dehydrate()
    {
        parent::dehydrate();
        $this->resource = $this->resource->routebase();
    }

    public function handleResourceNotFound()
    {
        throw new RamboNotFoundHttpException();
    }
}
