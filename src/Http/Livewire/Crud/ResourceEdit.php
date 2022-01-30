<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceEdit extends ResourceFormComponent
{
    public $pageType = 'edit';

    public function mount()
    {
        parent::mount();

        RamboBreadcrumbs::add('Editing ' . $this->resource->itemName());

        $this->component = $this->resource->editView();

        collect($this->resource->fieldStack('edit'))->each(function ($field) {
            $value = $field->item($this->resource->item)->getFormValue();
            $this->fields[$field->getName()] = $value;
        });
    }

    public function saveData()
    {
        $item = $this->resource->item;
        $item->update($this->fields);
        $item->touch();

        return $item;
    }
}
