<?php

namespace AngryMoustache\Rambo\Rambo;

use AngryMoustache\Rambo\Resource\Fields\AttachmentField;
use AngryMoustache\Rambo\Resource\Fields\BooleanField;
use AngryMoustache\Rambo\Resource\Fields\Button;
use AngryMoustache\Rambo\Resource\Fields\PasswordField;
use AngryMoustache\Rambo\Resource\Fields\TextField;
use AngryMoustache\Rambo\Resource\Resource;

class Administrator extends Resource
{
    public $displayName = 'username';

    public $model = 'AngryMoustache\Rambo\Models\Administrator';

    public $searchableFields = [
        'username',
        'email',
    ];

    public function fields()
    {
        $id = optional($this->item)->id;

        return [
            TextField::make('username')
                ->rules(['required', "unique:administrators,username,${id}"]),

            TextField::make('email')
                ->label('E-Mail')
                ->rules(['required', "unique:administrators,email,${id}", 'email']),

            PasswordField::make('password')
                ->placeholder('Leave empty if not changing')
                ->hideFrom(['index', 'show']),

            AttachmentField::make('avatar_id')
                ->label('Avatar')
                ->folder('avatars'),

            BooleanField::make('online'),

            Button::make('submit'),
        ];
    }
}
