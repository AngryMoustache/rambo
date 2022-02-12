<?php

namespace AngryMoustache\Rambo\Fields;

class CropperField extends Field
{
    public $livewireFormComponent = 'rambo-form-cropper-field';
    public $hideFrom = ['index', 'show', 'create'];
}
