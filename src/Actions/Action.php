<?php

namespace AngryMoustache\Rambo\Actions;

class Action
{
    public static $icon;
    public static $label;

    public static $livewireComponent = 'rambo-action';

    public static function getLivewireComponent()
    {
        return static::$livewireComponent;
    }
}
