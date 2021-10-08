<?php

namespace AngryMoustache\Rambo\Resource\Fields;

use AngryMoustache\Rambo\Facades\Rambo;

class PasswordField extends Field
{
    public $component = 'rambo::fields.form.password';

    public $showComponent = 'rambo::fields.show.password';

    public $dontAutoFillEdit = true;

    public function beforeSave($value)
    {
        if ($value === null) {
            $this->isField = false;
            return;
        }

        return Rambo::passwordHash($value);
    }
}
