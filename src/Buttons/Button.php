<?php

namespace AngryMoustache\Rambo\Buttons;

use AngryMoustache\Rambo\Traits\HasCanSee;
use AngryMoustache\Rambo\Traits\RamboMagic;

class Button
{
    use HasCanSee;
    use RamboMagic;

    public $component = 'rambo::components.crud.buttons.button';
    public $label;
    public $action;
    public $inline = false;

    public static function make()
    {
        return new static();
    }
}
