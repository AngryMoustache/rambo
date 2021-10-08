<?php

namespace AngryMoustache\Rambo\Rambo;

use AngryMoustache\Rambo\Resource\Fields\Button;
use AngryMoustache\Rambo\Resource\Fields\TextareaField;
use AngryMoustache\Rambo\Resource\Fields\TextField;
use AngryMoustache\Rambo\Resource\Resource;

class StaticString extends Resource
{
    public $routebase = 'static-strings';

    public $displayName = 'name';

    public $model = 'AngryMoustache\Rambo\Models\StaticString';

    public $searchableFields = [
        'scope',
        'key',
        'value',
    ];

    public function fields()
    {
        return [
            TextField::make('scope')
                ->rules('required'),

            TextField::make('key')
                ->rules('required'),

            TextareaField::make('value')
                ->rules('required'),

            Button::make('submit'),
        ];
    }
}
