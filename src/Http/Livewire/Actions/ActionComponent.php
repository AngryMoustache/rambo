<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

use AngryMoustache\Rambo\Actions\Action;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use AngryMoustache\Rambo\Resource;

class ActionComponent extends RamboComponent
{
    public $component = 'rambo::livewire.actions.action';

    public Action $action;
    public Resource $resource;

    public $item;
    public $label = false;

    public function mount()
    {
        parent::mount();
        $this->link = $this->action->getLink($this->resource, $this->item);
        $this->itemId = optional($this->item)->{$this->resource->primaryField()};
        $this->action->resource($this->resource);
    }

    public function handle()
    {
        return $this->action->handle($this);
    }
}
