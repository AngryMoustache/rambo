<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\FieldParser;

class ResourceFormComponent extends ResourceComponent
{
    public $fields = [];

    public $listeners = [
        'changed-value' => 'fieldUpdated',
    ];

    public function mount()
    {
        parent::mount();
        $this->rules = $this->resource->validationStack();
    }

    public function fieldUpdated($value, $field)
    {
        $field = FieldParser::hydrate($field);
        $this->fields[$field->getName()] = $value;
    }

    public function submit($redirect = true)
    {
        $model = $this->handleSubmit();
        return redirect($this->resource->show($model->{$this->resource->primaryField()}));
    }

    public function handleSubmit()
    {
        $this->emit('fields-validate');
        $this->validate();

        $fieldStack = $this->resource->fieldStack('form');

        // Default values
        $fieldStack->each(function ($field) {
            $name = $field->getName();
            $this->fields[$name] ??= $field->getDefault();
        });

        $this->cleanFields();

        // Before save methods
        $fieldStack->each(function ($field) {
            $name = $field->getName();
            $this->fields[$name] = $field->beforeSave(
                $this->fields[$name] ?? null,
                $this->fields,
                $this->itemId
            );
        });

        $this->cleanFields();
        return $this->saveData();
    }

    public function cleanFields()
    {
        foreach ($this->fields as $key => $value) {
            if (in_array($value, ['', null])) {
                unset($this->fields[$key]);
            }
        }
    }
}
