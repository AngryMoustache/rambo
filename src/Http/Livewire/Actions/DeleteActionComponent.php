<?php

namespace AngryMoustache\Rambo\Http\Livewire\Actions;

class DeleteActionComponent extends ActionComponent
{
    public $component = 'rambo::livewire.actions.delete-action';

    public $modal = false;

    public $route = false;

    public function mount($action = null, $item = null, $resource = null)
    {
        $this->action = new $action;
        $this->currentRoute = request()->route()->getName();
    }

    public function toggleModal()
    {
        $this->modal = ! $this->modal;
    }

    public function deleteConfirm()
    {
        $item = $this->item->{$this->resource->displayName()};
        $this->item->delete();

        if ($this->currentRoute === 'rambo.crud.index') {
            $this->toggleModal();
            $this->emit('refresh');
            $this->toastOk("'{$item}' has been deleted successfully!");
        } else {
            redirect($this->resource->index());
        }
    }
}
