<?php

namespace AngryMoustache\Rambo\Fields;

class BooleanField extends Field
{
    public $showComponent = 'rambo::livewire.fields.show.boolean';
    public $formComponent = 'rambo::livewire.fields.form.boolean';

    public function beforeSave($value, $fields, $id)
    {
        return (boolean) $value;
    }

    public function getValue()
    {
        return (boolean) parent::getValue();
    }
}
