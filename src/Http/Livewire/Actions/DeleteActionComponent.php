<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

class DeleteActionComponent extends ActionComponent
{
    public $component = 'rambo::livewire.actions.delete-action';

    public $modal = false;
    public $route = false;
    public $noRedirect = false;

    public function toggleModal()
    {
        $this->modal = ! $this->modal;
    }

    public function deleteConfirm()
    {
        $itemName = $this->resource->itemName();
        $toast = "'${itemName}' has been deleted successfully!";
        $this->item->delete();

        if ($this->noRedirect) {
            $this->emit('refresh');
            $this->toggleModal();
            $this->toastOk($toast);
        } else {
            $this->sessionToastOk($toast);
            $this->redirect($this->resource->index());
        }
    }
}
