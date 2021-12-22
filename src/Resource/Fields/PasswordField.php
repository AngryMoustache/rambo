<?php

namespace AngryMoustache\Rambo\Resource\Fields;

use AngryMoustache\Rambo\Facades\Rambo;

class PasswordField extends LivewireCustomField
{
    public $livewireComponent = 'rambo-fields-password-input';

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
