<?php

namespace AngryMoustache\Rambo\Actions;

class Action
{
    public $icon;
    public $label;

    public static $livewireComponent = 'rambo-action';

    public function shouldHide($resource = null, $currentRoute = null)
    {
        return false;
    }

    public static function getLivewireComponent()
    {
        return static::$livewireComponent;
    }
}
