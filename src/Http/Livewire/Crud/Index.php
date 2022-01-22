<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

class Index extends ResourceComponent
{
    public $items;

    public function mount()
    {
        parent::mount();
        $this->component = $this->resource->indexView();
        $this->items = $this->resource->indexQuery()->get();
    }
}
