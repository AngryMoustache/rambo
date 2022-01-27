<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Rambo\Models\Administrator as ModelsAdministrator;
use AngryMoustache\Rambo\Resource;
use AngryMoustache\Rambo\Fields\BooleanField;
use AngryMoustache\Rambo\Fields\IDField;
use AngryMoustache\Rambo\Fields\TextField;

class Administrator extends Resource
{
    public $model = ModelsAdministrator::class;

    public $displayName = 'username';

    public function fields()
    {
        return [
            IDField::make(),

            TextField::make('username')
                ->sortable()
                ->searchable(),

            TextField::make('email')
                ->label('E-Mail')
                ->sortable()
                ->searchable(),

            TextField::make('avatar_id')
                ->label('Avatar'),

            BooleanField::make('online')
                ->sortable(),
        ];
    }
}
