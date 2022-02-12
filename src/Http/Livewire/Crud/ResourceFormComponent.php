<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableRamboItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResourceFormComponent extends ResourceComponent
{
    public $fields = [];
    public $labels = [];

    public $pageType;

    public $listeners = [
        'changed-value' => 'fieldUpdated',
        'refresh',
    ];

    public function mount()
    {
        parent::mount();
        $this->rules = collect($this->resource->validationStack($this->pageType))
            ->mapWithKeys(fn ($rules, $key) => [Str::replaceFirst('fields.', '', $key) => $rules])
            ->toArray();

        // Fill in the data
        $this->resource->flatFieldStack($this->pageType, $this->resource->item)->each(function ($field) {
            $this->fields[$field->getName()] = $field->getFormValue();
            $this->labels[$field->getName()] = $field->getLabel();
        });
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
        if (! $model) {
            $this->toastError('Something went wrong while saving!');
            return;
        }

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
        if (! $this->validateStack()) {
            $this->emit('fields-validate');
            return null;
        }

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
        $fields = collect($this->resource->flatFieldStack($this->pageType));

        $fields->each(function ($field) use (&$relations) {
            $name = $field->getName();
            if ($field->isHasManyRelation() && isset($this->fields[$name])) {
                $relations[$name] = $this->fields[$name];
            }
        });

        return $relations;
    }

    // Validate one field
    public function updatedFields($value, $key)
    {
        $validator = Validator::make([$key => $value], [$key => $this->rules[$key]]);
        $this->validateWith($validator, false);
    }

    // Validate all fields (submit)
    public function validateStack()
    {
        $validator = Validator::make($this->fields, $this->rules);
        return $this->validateWith($validator);
    }

    public function validateWith($validator, $withMessage = true)
    {
        if ($validator->fails()) {
            $messages = $validator->getMessageBag()->toArray();
            foreach ($messages as $field => $errors) {
                foreach ($errors as $error) {
                    $this->addError($field, $error);
                    if ($withMessage) {
                        $label = $this->labels[$field] ?? $field;
                        $this->toastWarning("Validation error for the '${label}' field.");
                    }
                }
            }

            return false;
        }

        return true;
    }
}
