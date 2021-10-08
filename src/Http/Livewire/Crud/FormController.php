<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use AngryMoustache\Rambo\Resource\Fields\Field;
use AngryMoustache\Rambo\Resource\Resource;

class FormController extends RamboComponent
{
    public $resourceName;

    public $rules = [];

    public $fields = [];

    public $pageType;

    public $currentUrl;

    protected $listeners = [
        'field:update' => 'updateField',
        'field:unset' => 'unsetField',
    ];

    public $hasSubmitted = false;

    public function mount(Resource $resource)
    {
        $this->currentUrl = request()->url();
        $this->resourceName = $resource->routebase();
        $this->rules = $resource->validationFieldStack();
        $this->fields = $resource->defaultValues();
    }

    public function render()
    {
        $resource = $this->resource();

        if ($this->hasSubmitted && count($this->getErrorBag()->all()) > 0){
            $this->hasSubmitted = false;
            $this->toast(
                'Unable to save, please check if you filled in all fields correctly',
                'error'
            );
        }

        return view($this->component, [
            'resource' => $resource,
        ]);
    }

    public function resource()
    {
        return Rambo::resource($this->resourceName);
    }

    public function updateField($value, $fieldName)
    {
        $this->fields[$fieldName] = $value;
        $this->updated($fieldName);
    }

    public function unsetField($fieldName)
    {
        unset($this->fields[$fieldName]);
        $this->updated($fieldName);
    }

    public function updated($field)
    {
        if ($this->rules !== []) {
            $this->validateOnly($field);
        }
    }

    public function submit()
    {
        $this->hasSubmitted = true;
        if ($this->rules !== []) {
            $this->validate();
        }

        $id = (isset($this->item) ? $this->item->id : null);
        $resource = $this->resource();

        // BeforeSave methods & defaults
        collect($resource->formFieldStack('', true))->each(function (Field $field) use ($id) {
            $name = $field->getName();
            if (! empty($name)) {
                $field->resource = $this->resource();
                $field->formFields = $this->fields;
                $field->itemId = $id;
                $this->fields[$name] ??= $field->getDefault();
                $this->fields[$name] = $field->beforeSave($this->fields[$name], $id);

                // Must be final step (password field)
                if ($field->isField === false) {
                    unset($this->fields[$name]);
                }
            }
        });

        $this->saveData();
    }

    public function habtmRelations()
    {
        $relations = [];
        $fields = collect($this->resource()->formFieldStack('', true));

        $fields->each(function ($field) use (&$relations) {
            $name = $field->getName();

            if ($field->hasManyRelation && isset($this->fields[$name])) {
                $relations[$name] = $this->fields[$name];
            }
        });

        return $relations;
    }

    public function emitForms()
    {
        $this->emitUp('form:emit', $this);
    }
}
