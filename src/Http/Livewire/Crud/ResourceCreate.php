<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceCreate extends ResourceFormComponent
{
    public $pageType = 'create';

    public function mount()
    {
        parent::mount();
        RamboBreadcrumbs::add('Create ' . $this->resource->singularLabel());

        if (! $this->resource->canCreate()) {
            return Rambo::unauthorized();
        }

        $this->component = $this->resource->createView();
    }

    public function saveData()
    {
        $model = $this->resource->model();
        $savedModel = $model::withoutGlobalScopes()->create($this->fields);
        return $savedModel;
    }
}
