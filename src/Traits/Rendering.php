<?php

namespace AngryMoustache\Rambo\Traits;

trait Rendering
{
    public $indexLivewireComponent = 'rambo-resource-index';
    public $createLivewireComponent = 'rambo-resource-create';
    public $showLivewireComponent = 'rambo-resource-show';
    public $editLivewireComponent = 'rambo-resource-edit';

    public $indexView = 'rambo::livewire.crud.resource-index';
    public $createView = 'rambo::livewire.crud.resource-create';
    public $showView = 'rambo::livewire.crud.resource-show';
    public $editView = 'rambo::livewire.crud.resource-edit';

    public $indexTableBlade = 'rambo::components.crud.tables.index';
    public $habtmComponent = 'rambo::components.habtm.item';

    public $preLoadIndex = true;

    public function indexLivewireComponent()
    {
        return $this->indexLivewireComponent;
    }

    public function createLivewireComponent()
    {
        return $this->createLivewireComponent;
    }

    public function showLivewireComponent()
    {
        return $this->showLivewireComponent;
    }

    public function editLivewireComponent()
    {
        return $this->editLivewireComponent;
    }

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

    public function habtmComponent()
    {
        return $this->habtmComponent;
    }
}
