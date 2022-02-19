<?php

namespace AngryMoustache\Rambo\Filters;

use AngryMoustache\Rambo\Fields\BooleanField;

class OnlineFilter extends Filter
{
    public function fields()
    {
        return [
            BooleanField::make('online'),
        ];
    }

    public function handle($value, $resource)
    {
        return $resource->item->online === $value;
    }
}
