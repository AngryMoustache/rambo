<?php

namespace AngryMoustache\Rambo\Fields;

class CropperField extends Field
{
    public $bladeFormComponent = 'rambo::livewire.fields.form.cropper';
    public $hideFrom = ['index', 'show', 'create'];
}
