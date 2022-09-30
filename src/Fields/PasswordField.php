<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Facades\Rambo;

class PasswordField extends Field
{
    public $type = 'password';

    public $unsetWhenNull = true;

    public $hideFrom = ['index', 'show'];

    public function getFormValue()
    {
        return null;
    }

    public function beforeSave($value, $fields, $id)
    {
        return Rambo::passwordHash($value);
    }
}
