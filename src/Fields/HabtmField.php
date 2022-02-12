<?php

namespace AngryMoustache\Rambo\Fields;

class HabtmField extends HasManyField
{
    public $hideFrom = ['index'];

    public $livewireFormComponent = 'rambo-form-habtm-field';

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
