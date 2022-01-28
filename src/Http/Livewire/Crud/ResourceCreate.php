<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

class ResourceCreate extends ResourceFormComponent
{
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
