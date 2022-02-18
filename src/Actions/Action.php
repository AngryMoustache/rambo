<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WireableRamboItem;
use AngryMoustache\Rambo\Traits\RamboMagic;

class Action extends WireableRamboItem
{
    use RamboMagic;

    public $icon;
    public $label;

    public $livewireComponent = 'rambo-action';

    public $canSee = true;

    public static function make()
    {
        return new static();
    }

    public function getLink($resource, $item)
    {
        //
    }

    public function shouldHide()
    {
        return false;
    }
}
