<?php

namespace AngryMoustache\Rambo\Traits;

trait Rendering
{
    public $indexView = 'rambo::livewire.crud.index';
    // public $createView = 'rambo::livewire.crud.create';
    // public $showView = 'rambo::livewire.crud.show';
    // public $editView = 'rambo::livewire.crud.edit';
    // public $deleteView = 'rambo::livewire.crud.delete';

    public $indexTableView = 'rambo::components.crud.tables.index';
    // public $habtmComponent = 'rambo::components.habtm.item';

    public function indexView()
    {
        return $this->indexView;
    }

    // public function createView()
    // {
    //     return $this->createView;
    // }

    // public function showView()
    // {
    //     return $this->showView;
    // }

    // public function editView()
    // {
    //     return $this->editView;
    // }

    // public function deleteView()
    // {
    //     return $this->deleteView;
    // }

    public function indexTableView()
    {
        return $this->indexTableView;
    }

    // public function habtmComponent()
    // {
    //     return $this->habtmComponent;
    // }
}
