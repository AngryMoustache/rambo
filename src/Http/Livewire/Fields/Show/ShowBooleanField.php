<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields\Show;

use AngryMoustache\Rambo\Http\Livewire\Fields\ShowField;

class ShowBooleanField extends ShowField
{
    public function toggle($newValue)
    {
        if (! $this->field->isToggleable()) {
            return;
        }

        $item = $this->field->getItem();
        $item->{$this->field->getName()} = $newValue;
        $item->save();

        $this->toastOk("The {$this->field->getName()} value has been updated");
        $this->updateValue($item);
    }
}
