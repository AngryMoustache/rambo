<?php

namespace AngryMoustache\Rambo\Resources;

use AngryMoustache\Rambo\Facades\Rambo;
use AngryMoustache\Rambo\Fields\AttachmentField;
use AngryMoustache\Rambo\Models\Administrator as ModelsAdministrator;
use AngryMoustache\Rambo\Resource;
use AngryMoustache\Rambo\Fields\BooleanField;
use AngryMoustache\Rambo\Fields\IDField;
use AngryMoustache\Rambo\Fields\PasswordField;
use AngryMoustache\Rambo\Fields\TextField;

class Administrator extends Resource
{
    public $model = ModelsAdministrator::class;

    public $displayName = 'username';

    public $preLoadIndex = false;

    public $globalSearchBladeComponent = 'rambo::components.global-search.admin';

    public function fields()
    {
        return [
            IDField::make(),

            TextField::make('username')
                ->sortable()
                ->searchable()
                ->rules('required'),

            PasswordField::make('password')
                ->createRules('required'),

            TextField::make('email')
                ->label('E-Mail')
                ->rules('required|email')
                ->sortable()
                ->searchable(),

            AttachmentField::make('avatar_id')
                ->label('Avatar'),

            BooleanField::make('online')
                ->sortable(),
        ];
    }

    public function canDelete()
    {
        // Don't delete yourself
        return $this->itemId() !== Rambo::user()->id;
    }
}
