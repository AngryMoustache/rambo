<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Fields\Traits\HasNestedFields;

class GroupField extends Field
{
    use HasNestedFields;

    public $bladeShowComponent = 'rambo::livewire.fields.show.group';
    public $bladeFormComponent = 'rambo::livewire.fields.form.group';

    public $hideLabelOnShow = true;

    public static function make($label = null, $fields = null)
    {
        return new static($label, $fields);
    }

    public function __construct($label = null, $fields = null)
    {
        $this->label ??= $label;
        $this->fields ??= $fields;
    }
}
