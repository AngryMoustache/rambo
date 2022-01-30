<?php

namespace AngryMoustache\Rambo\Traits;

trait Rendering
{
    public $indexView = 'rambo::livewire.crud.resource-index';
    public $createView = 'rambo::livewire.crud.resource-create';
    public $showView = 'rambo::livewire.crud.resource-show';
    public $editView = 'rambo::livewire.crud.resource-edit';

    public $indexTableBlade = 'rambo::components.crud.tables.index';
    public $preLoadIndex = true;

    public function indexView()
    {
        return $this->indexView;
    }

    public function createView()
    {
        return $this->createView;
    }

    public function showView()
    {
        return $this->showView;
    }

    public function editView()
    {
        return $this->editView;
    }

    public function indexTableBlade()
    {
        return $this->indexTableBlade;
    }
}
