<?php

namespace AngryMoustache\Rambo\Filters;

use AngryMoustache\Rambo\Http\Livewire\Wireables\WiredRamboItem;
use AngryMoustache\Rambo\Traits\Fields;
use AngryMoustache\Rambo\Traits\HasCanSee;
use AngryMoustache\Rambo\Traits\RamboMagic;
use Exception;
use Illuminate\Support\Str;

class Filter extends WiredRamboItem
{
    use HasCanSee;
    use RamboMagic;

    public $label;
    public $enabled = false;
    public $fields;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        if (! $this->label) {
            $name = Str::afterLast(get_class($this), '\\');
            $label = Str::ucfirst(implode(' ', preg_split('/(?=[A-Z])/', $name)));
            $this->label = $label;
        }
    }

    public function filterFields()
    {
        throw new Exception('No filterFields() function found on ' . get_class($this));
    }

    public function handle($resource)
    {
        throw new Exception('No handle() function found on ' . get_class($this));
    }
}
