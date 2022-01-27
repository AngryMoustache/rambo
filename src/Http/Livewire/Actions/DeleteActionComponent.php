<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class DeleteActionComponent extends RamboComponent
{
    public $component = 'rambo::livewire.actions.delete-action';

    public $action;
    public $item;

    // public function mount($action = null, $item = null, $resource = null)
    // {
    //     parent::mount();
    //     $this->link = '';
    // }
}
