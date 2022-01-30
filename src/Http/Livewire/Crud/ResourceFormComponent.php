<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableField;

class ResourceFormComponent extends ResourceComponent
{
    public $fields = [];

    public $listeners = [
        'changed-value' => 'fieldUpdated',
        'refresh',
    ];

    public function mount()
    {
        parent::mount();
        $this->rules = $this->resource->validationStack($this->pageType);
    }

    public function fieldUpdated($value, $field)
    {
        $field = (new WireableField())->fromLivewire($field);
        $this->fields[$field->getName()] = $value;
    }

    public function cancel()
    {
        if ($this->itemId) {
            return redirect($this->resource->show());
        }

        return redirect($this->resource->index());
    }

    public function submit($redirect = true)
    {
        $model = $this->handleSubmit();
        if ($redirect) {
            if ($this->itemId) {
                return redirect($this->resource->routeAfterEdit());
            }

            return redirect($this->resource->item($model)->routeAfterCreate());
        }

        $this->toastOk("{$this->resource->singularLabel()} successfully saved!");
    }

    public function handleSubmit()
    {
        $this->emit('fields-validate');
        $this->validate();

        $fieldStack = $this->resource->fieldStack($this->pageType);

        // Default values
        $fieldStack->each(function ($field) {
            $name = $field->getName();
            $this->fields[$name] ??= $field->getDefault();
        });

        // Before save methods
        $fieldStack->each(function ($field) {
            $name = $field->getName();
            $this->fields[$name] = $field->beforeSave(
                $this->fields[$name] ?? null,
                $this->fields,
                $this->itemId
            );
        });

        return $this->saveData();
    }
}
