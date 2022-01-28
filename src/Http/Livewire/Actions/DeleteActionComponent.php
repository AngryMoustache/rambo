<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

class DeleteActionComponent extends ActionComponent
{
    public $component = 'rambo::livewire.actions.delete-action';

    public $modal = false;

    public function mount($action = null, $item = null, $resource = null)
    {
        $this->action = new $action;
    }

    public function toggleModal()
    {
        $this->modal = ! $this->modal;
    }

    public function deleteConfirm()
    {
        $this->item->delete();
        $this->toggleModal();
        $this->emit('refresh');
    }
}
