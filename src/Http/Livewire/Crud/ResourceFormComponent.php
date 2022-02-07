<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableRamboItem;
use Illuminate\Support\Arr;

class ResourceFormComponent extends ResourceComponent
{
    public $fields = [];

    public $pageType;

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
        $field = (new WireableRamboItem())->fromLivewire($field);
        $this->fields[$field->getName()] = $value;
    }

    public function cancel()
    {
        if ($this->itemId) {
            $this->redirect($this->resource->show());
        } else {
            $this->redirect($this->resource->index());
        }
    }

    public function submitContinue()
    {
        return $this->submit(false);
    }

    public function submit($redirect = true)
    {
        $model = $this->handleSubmit();
        $toast = "{$this->resource->singularLabel()} successfully saved!";

        if ($redirect) {
            $redirect = $this->itemId
                ? $this->resource->routeAfterEdit()
                : $this->resource->item($model)->routeAfterCreate();

            $this->sessionToastOk($toast);
            return $this->redirect($redirect);
        }

        $this->toastOk($toast);
    }

    public function handleSubmit()
    {
        $this->emit('fields-validate');
        $this->validate();

        $fieldStack = $this->resource->fieldStack($this->pageType);

        // Default values
        $fieldStack->each(function ($field) {
            $this->fields[$field->getName()] ??= $field->getDefault();
        });

        // Unset fields
        $fieldStack->each(function ($field) {
            $name = $field->getName();

            // Clear empty strings
            if ($this->fields[$name] === '' && ! $field->getDontClearEmpty()) {
                $this->fields[$name] = null;
            }

            // Unset when null fields (passwords etc.)
            if ($field->isUnsetWhenNull() && is_null($this->fields[$name])) {
                unset($this->fields[$name]);
            }
        });

        // Before save methods
        $fieldStack->each(function ($field) {
            $name = $field->getName();
            if (Arr::has($this->fields, $name)) {
                $this->fields[$name] = $field->beforeSave(
                    $this->fields[$name] ?? null,
                    $this->fields,
                    $this->itemId
                );
            }
        });

        $item = $this->saveData();

        // HABTM relations
        foreach ($this->getHabtmRelations() as $relation => $values) {
            $item->{$relation}()->detach();
            $item->{$relation}()->sync($values);
        }

        return $item;
    }

    public function getHabtmRelations()
    {
        $relations = [];
        $fields = collect($this->resource->fieldStack($this->pageType));

        $fields->each(function ($field) use (&$relations) {
            $name = $field->getName();

            if ($field->isHasManyRelation() && isset($this->fields[$name])) {
                $relations[$name] = $this->fields[$name];
            }
        });

        return $relations;
    }
}
