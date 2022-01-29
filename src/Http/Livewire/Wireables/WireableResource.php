<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use AngryMoustache\Rambo\Facades\Rambo;
use Livewire\Wireable;

class WireableResource implements Wireable
{
    public function toLivewire()
    {
        $return = 'rambo-resource::' . $this->routebase();
        if ($this->item) {
            $return .= '::' . $this->itemId();
        }

        return $return;
    }

    public static function fromLivewire($field)
    {
        $parts = explode('::', $field);
        return Rambo::resource($parts[1], $parts[2] ?? null);
    }
}
