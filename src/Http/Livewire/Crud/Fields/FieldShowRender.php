<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud\Fields;

use AngryMoustache\Rambo\Http\Livewire\RamboComponent;

/** Basic render component for text based fields */
class FieldShowRender extends RamboComponent
{
    public $component = 'rambo::livewire.fields.show.text';

    public $value;

    public function mount($field = null, $item = null)
    {
        parent::mount();
        $this->value = $field->item($item)->getShowValue();
        $this->component = $field->getShowComponent() ?? $this->component;
    }
}
