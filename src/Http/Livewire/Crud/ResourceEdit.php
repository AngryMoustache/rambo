<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Facades\RamboBreadcrumbs;

class ResourceEdit extends ResourceFormComponent
{
    public $pageType = 'edit';

    public function mount()
    {
        parent::mount();

        RamboBreadcrumbs::add('Editing ' . $this->resource->itemName());

        if (! $this->resource->canEdit()) {
            return Rambo::unauthorized();
        }

        $this->component = $this->resource->editView();

        collect($this->resource->fieldStack('edit', $this->resource->item))->each(function ($field) {
            $this->fields[$field->getName()] = $field->getFormValue();
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
