<?php

namespace AngryMoustache\Rambo\Filters;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WiredRamboItem;
use AngryMoustache\Rambo\Traits\HasCanSee;
use AngryMoustache\Rambo\Traits\RamboMagic;
use Illuminate\Support\Str;

abstract class Filter extends WiredRamboItem
{
    use HasCanSee;
    use RamboMagic;

    public $label;
    public $enabled = false;
    public $fields;

    abstract public function handle($resource);

    public function filterFields()
    {
        return [];
    }

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $name = Str::afterLast(get_class($this), '\\');
        $label = Str::ucfirst(implode(' ', preg_split('/(?=[A-Z])/', $name)));
        $this->label = $label;
    }
}
