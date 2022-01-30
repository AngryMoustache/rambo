<?php

namespace AngryMoustache\Rambo\Fields;

class HabtmField extends HasManyField
{
    public $hideFrom = [];

    public $formComponent = 'rambo::livewire.fields.form.habtm';

    public $hasManyRelation = true;

    public function getFormValue()
    {
        return parent::getFormValue()->pluck('id', 'id')->toArray();
    }
}
