<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

class DeleteActionComponent extends RamboComponent
{
    public $component = 'rambo::livewire.actions.delete-action';
    public $action;
    public $item;

    public $modal = false;

    public function toggleModal()
    {
        $this->modal = ! $this->modal;
    }

    public function deleteConfirm()
    {
        $this->item->delete();
        $this->toggleModal();
        $this->emitUp('refresh');
    }
}
