<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceCreate extends ResourceFormComponent
{
    public function booted()
    {
        parent::booted();
        RamboBreadcrumbs::add('Create ' . $this->resource->singularLabel());
    }

    public function mount()
    {
        parent::mount();
        $this->component = $this->resource->createView();
    }

    public function saveData()
    {
        $model = $this->resource->model();
        $savedModel = $model::withoutGlobalScopes()->create($this->fields);
        return $savedModel;
    }
}
