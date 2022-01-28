<?php

namespace AngryMoustache\Rambo\Fields;

use Illuminate\Support\Str;

/**
 * @method object nameField(string $field = 'name')
 */
class SlugField extends Field
{
    public function beforeSave($value, $fields, $id)
    {
        return $value ?? Str::slug($fields[$this->getNameField() ?? 'name']);
    }
}
