<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Rambo\Models\Administrator as ModelsAdministrator;
use AngryMoustache\Rambo\Resource;
use AngryMoustache\Rambo\Fields\BooleanField;
use AngryMoustache\Rambo\Fields\TextField;

class Administrator extends Resource
{
    public $model = ModelsAdministrator::class;

    public function fields()
    {
        return [
            TextField::make('id')
                ->label('ID'),

            TextField::make('username')
                ->searchable(),

            TextField::make('email')
                ->label('E-Mail')
                ->searchable(),

            TextField::make('avatar_id')
                ->label('Avatar'),

            BooleanField::make('online'),
        ];
    }
}
