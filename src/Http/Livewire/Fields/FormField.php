<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use AngryMoustache\Rambo\Resource;
use Illuminate\Support\Facades\Validator;

/**
 * Basic form render component for text based fields
 */
class FormField extends RamboComponent
{
    public $name;

    public $value;

    public Field $field;

    public Resource $resource;

    public $rules = [];

    public $listeners = [
        'fields-validate' => 'validateField',
    ];

    public function mount($field = null, $item = null, $rules = [])
    {
        parent::mount();
        $this->name = $field->getName();
        $this->value = $field->item($item)->getFormValue();
        $this->component ??= $field->getFormComponent();
        $this->rules = $rules;
    }

    public function emitValue()
    {
        $this->emitUp('changed-value', $this->value, $this->field->toLivewire());
    }

    public function updatedValue()
    {
        $this->validateField();
        $this->emitValue();
    }

    public function validateField()
    {
        $validator = Validator::make(
            [$this->name => $this->value],
            [$this->name => $this->rules]
        );

        if ($validator->fails()) {
            $this->addError($this->name, implode(', ', $validator->errors()->all()));
        } else {
            $this->resetErrorBag();
        }
    }
}
