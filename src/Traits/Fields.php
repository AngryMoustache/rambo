<?php

namespace AngryMoustache\Rambo\Traits;

trait Fields
{
    public $fields;

    abstract public function fields();

    /**
     * Returns the full field stack of the resource
     * You can specify the page you are on to look at the fields hideFrom
     */
    public function fieldStack($stack = '')
    {
        return collect($this->fields())
            ->reject(fn ($field) => in_array($stack, $field->getHideFrom() ?? []));
    }
}
