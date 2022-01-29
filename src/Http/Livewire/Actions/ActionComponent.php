<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

use AngryMoustache\Rambo\Actions\Action;
use AngryMoustache\Rambo\Http\Livewire\Crud\ResourceComponent;

class ActionComponent extends ResourceComponent
{
    public $component = 'rambo::livewire.actions.action';

    public Action $action;
    public $item;
    public $label = false;
    public $currentRoute;

    public function mount($action = null, $item = null, $resource = null)
    {
        parent::mount();
        $this->link = $this->action->getLink($resource, $item);
        $this->itemId = optional($item)->{$resource->primaryField()};
        $this->currentRoute = request()->url();
    }
}
