<?php

namespace AngryMoustache\Rambo\Http\Livewire\Fields\Form;

use AngryMoustache\Rambo\Http\Livewire\Fields\FormField;

class FormAttachmentField extends FormField
{
    public $component = 'rambo::livewire.fields.form.attachment';

    public $listeners = [
        'fields-validate' => 'validateField',
        'picked-attachment' => 'pickedAttachment',
    ];

    public function pickedAttachment($value, $field)
    {
        $this->value = $value;
        $this->updatedValue();
    }
}
