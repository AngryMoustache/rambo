<?php

namespace AngryMoustache\Rambo\Http\Livewire\Crud;

use AngryMoustache\Rambo\FieldParser;

class ResourceFormComponent extends ResourceComponent
{
    public $fields = [];

    public $listeners = [
        'changed-value' => 'fieldUpdated',
    ];

    public function fieldUpdated($value, $field)
    {
        $field = FieldParser::hydrate($field);
        $this->fields[$field->getName()] = $value;
    }

    public function submit()
    {
        dd($this->fields);
    }
}
