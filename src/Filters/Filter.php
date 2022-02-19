<?php

namespace AngryMoustache\Rambo\Filters;

use AngryMoustache\Rambo\Traits\HasCanSee;
use AngryMoustache\Rambo\Traits\RamboMagic;

abstract class Filter
{
    use HasCanSee;
    use RamboMagic;

    abstract public function fields();
    abstract public function handle($value, $resource);

    public static function make()
    {
        return new static();
    }
}
