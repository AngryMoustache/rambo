<?php

namespace AngryMoustache\Rambo\Actions;

class Action
{
    public $icon;
    public $label;

    public static $livewireComponent = 'rambo-action';

    public static function getLivewireComponent()
    {
        return static::$livewireComponent;
    }
}
