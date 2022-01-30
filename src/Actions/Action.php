<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableAction;

class Action extends WireableAction
{
    public $icon;
    public $label;

    public static $livewireComponent = 'rambo-action';

    public static function getLivewireComponent()
    {
        return static::$livewireComponent;
    }

    public function shouldHide($resource = null)
    {
        return false;
    }

    public function getLink($resource, $item)
    {
        //
    }
}
