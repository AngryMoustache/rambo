<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use AngryMoustache\Rambo\Facades\Rambo;
use Livewire\Wireable;

class WireableResource implements Wireable
{
    public function toLivewire()
    {
        $return = 'rambo-resource::' . $this;
        if ($this->item) {
            $return .= '::' . $this->itemId();
        }

        return $return;
    }

    public static function fromLivewire($resource)
    {
        $parts = explode('::', $resource);
        return Rambo::resource($parts[1], $parts[2] ?? null);
    }
}
