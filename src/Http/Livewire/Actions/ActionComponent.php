<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceComponent;

class ActionComponent extends ResourceComponent
{
    public $component = 'rambo::livewire.actions.action';

    public $action;
    public $item;
    public $label = false;
    public $currentRoute;

    public function mount($action = null, $item = null, $resource = null)
    {
        parent::mount();
        $this->action = new $action;
        $this->link = $this->action->getLink($resource, $item);
        $this->itemId = optional($item)->{$resource->primaryField()};
        $this->currentRoute = request()->url();
    }

    public function hydrate()
    {
        parent::hydrate();
        $this->action = new $this->action;
    }

    public function dehydrate()
    {
        parent::dehydrate();
        $this->action = get_class($this->action);
    }
}
