<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

/**
 * Basic render component for text based fields
 */
class ShowField extends RamboComponent
{
    public $component;

    public $value;

    public Field $field;

    public function mount($field = null, $item = null)
    {
        parent::mount();
        $this->field = $field;
        $this->component = $field->getShowComponent();
        $this->updateValue($item);
    }

    public function updateValue($item)
    {
        $this->value = $this->field->item($item)->getShowValue();
        $this->emit('refresh');
    }
}
