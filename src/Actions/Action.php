<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableRamboItem;
use AngryMoustache\Rambo\Traits\HasCanSee;

class Action extends WireableRamboItem
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
