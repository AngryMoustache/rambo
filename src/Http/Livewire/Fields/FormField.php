<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;
use Illuminate\Support\Facades\Validator;

/** Basic form render component for text based fields */
class FormField extends RamboComponent
{
    public $component = 'rambo::livewire.fields.form.text';

    public $name;

    public $value;

    public Field $field;

    public $rules = [];

    public $listeners = [
        'fields-validate' => 'validateField',
    ];

    public function mount($field = null, $item = null)
    {
        parent::mount();
        $this->name = $field->getName();
        $this->value = $field->item($item)->getFormValue();
        $this->component = $field->getFormComponent() ?? $this->component;
        $this->rules = $this->field->getRules() ?? [];
    }

    public function emitValue()
    {
        $this->emitUp('changed-value', $this->value, $this->field->toLivewire());
    }

    public function updatedValue()
    {
        $this->validateField(false);
        $this->emitValue();
    }

    public function validateField($withMessage = true)
    {
        $validator = Validator::make(
            [$this->name => $this->value],
            [$this->name => $this->rules]
        );

        if ($validator->fails()) {
            $this->addError($this->name, implode(', ', $validator->errors()->all()));

            if ($withMessage) {
                $this->toastWarning("Validation error for the '{$this->name}' field.");
            }
        } else {
            $this->resetErrorBag();
        }
    }
}
