<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use Livewire\Wireable;

class WireableAction implements Wireable
{
    public function toLivewire()
    {
        return get_class($this);
    }

    public static function fromLivewire($action)
    {
        return new $action;
    }
}
