<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use Illuminate\Support\Collection;
use Livewire\Wireable;

class WiredRamboCollection extends Collection implements Wireable
{
    public function toLivewire()
    {
        return $this->map(fn ($item) => [
            'class' => get_class($item),
            'value' => $item->toLivewire(),
        ]);
    }

    public static function fromLivewire($array)
    {
        return self::wrap($array)->map(function ($item) {
            return (new $item['class'])::fromLivewire($item['value']);
        });
    }
}
