<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Resource\Resource;
use Livewire\Component;

class ResourceItem extends Component
{
    public $component;
    public $resourceName;
    public $item;
    public $currentUrl;

    public function mount($resource, $item)
    {
        $this->currentUrl = request()->url();
        $this->resourceName = $resource->routebase;
        $this->item = $item;
    }

    public function render()
    {
        $resource = $this->resource();

        return view($this->component, [
            'resource' => $resource,
        ]);
    }

    public function resource(): Resource
    {
        return Rambo::resource($this->resourceName);
    }
}