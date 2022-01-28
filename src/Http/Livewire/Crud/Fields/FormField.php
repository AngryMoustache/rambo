<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud\Fields;

use AngryMoustache\Rambo\FieldParser;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

/** Basic form render component for text based fields */
class FormField extends RamboComponent
{
    public $component = 'rambo::livewire.fields.form.text';

    public $value;
    public $field;

    public function mount($field = null, $item = null)
    {
        parent::mount();
        $this->value = $field->item($item)->getFormValue();
        $this->component = $field->getFormComponent() ?? $this->component;
    }

    public function updatedValue()
    {
        $this->emitValue();
    }

    public function emitValue()
    {
        $this->emitUp(
            'changed-value',
            $this->value,
            FieldParser::dehydrate($this->field)
        );
    }

    public function hydrate()
    {
        parent::hydrate();
        $this->field = FieldParser::hydrate($this->field);
    }

    public function dehydrate()
    {
        parent::hydrate();
        $this->field = FieldParser::dehydrate($this->field);
    }
}
