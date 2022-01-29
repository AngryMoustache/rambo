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
        $item = $this->item->{$this->resource->displayName()};
        $this->item->delete();

        if ($this->noRedirect) {
            $this->emit('refresh');
            $this->toggleModal();
            $this->toastOk("'{$item}' has been deleted successfully!");
        } else {
            redirect($this->resource->index());
        }
    }
}
