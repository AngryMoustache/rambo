<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Http\Exceptions\RamboResourceNotFoundHttpException;
use AngryMoustache\Rambo\Http\Exceptions\RamboResourceWithIdNotFoundHttpException;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use AngryMoustache\Rambo\Resource;

class ResourceComponent extends RamboComponent
{
    public $itemId;

    public Resource $resource;

    public function mount()
    {
        parent::mount();

        if (! $this->resource) {
            throw new RamboResourceNotFoundHttpException();
        }

        if ($this->itemId && ! optional($this->resource)->item) {
            throw new RamboResourceWithIdNotFoundHttpException();
        }
    }

    public function refresh()
    {
        if (! optional($this->resource)->item && $this->itemId) {
            redirect($this->resource->index());
        }
    }
}
