<?php

namespace AngryMoustache\Rambo\Fields;

class HabtmField extends HasManyField
{
    public $hideFrom = [];

    public $formComponent = 'rambo::livewire.fields.form.habtm';

    public $hasManyRelation = true;

    public function getFormValue()
    {
        $value = parent::getFormValue();
        if (! $value) {
            return [];
        }

        return $value->pluck('id', 'id')->toArray();
    }
}
