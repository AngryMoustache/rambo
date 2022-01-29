<?php

namespace AngryMoustache\Rambo\Fields;

use Illuminate\Support\Str;

/**
 * @method $this nameField(string $field = 'name') The name field to slug after saving
 */
class SlugField extends Field
{
    public function beforeSave($value, $fields, $id)
    {
        return $value ?? Str::slug($fields[$this->getNameField() ?? 'name']);
    }
}
