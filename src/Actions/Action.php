<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WiredRamboItem;
use AngryMoustache\Rambo\Traits\HasCanSee;

class Action extends WiredRamboItem
{
    use HasCanSee;

    public $icon;
    public $label;

    public $livewireComponent = 'rambo-action';

    public static function make()
    {
        return new static();
    }

    public function getLink($resource, $item)
    {
        //
    }
}
