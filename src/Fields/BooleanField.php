<?php

namespace AngryMoustache\Rambo\Fields;

/**
 * @method $this toggleable(boolean $toggleable = false) Determines if you can toggle the boolean from the overview/detail page
 */
class BooleanField extends Field
{
    public $showComponent = 'rambo::livewire.fields.show.boolean';
    public $formComponent = 'rambo::livewire.fields.form.boolean';

    public $livewireShowComponent = 'rambo-field-show-boolean-field';

    public $toggleable = false;

    public function beforeSave($value, $fields, $id)
    {
        return (boolean) $value;
    }

    public function getValue()
    {
        return (boolean) parent::getValue();
    }
}
