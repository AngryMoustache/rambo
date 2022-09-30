<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use AngryMoustache\Rambo\Resource;
use AngryMoustache\Rambo\Traits\RamboMagic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Wireable;

class WiredRamboItem implements Wireable
{
    use RamboMagic;

    public function toLivewire()
    {
        $item = clone $this;

        foreach (array_keys((array) $item) as $key) {
            $value = $item->{$key};
            if ($value instanceof Model) {
                $item->{$key} = 'rambo-model::' . get_class($value) . '::' . $value->id;
            }

            if ($value instanceof Resource) {
                $item->{$key} = $item->{$key}->toLivewire();
            }
        }

        return base64_encode(json_encode([
            'class' => get_class($item),
            'values' => get_object_vars($item),
        ]));
    }

    public static function fromLivewire($item)
    {
        $item = json_decode(base64_decode($item));
        $values = collect($item->values ?? []);
        $item = new $item->class;

        $values->each(function ($value, $key) use (&$item) {
            // Fetch models again
            if (is_string($value) && Str::startsWith($value, 'rambo-model::')) {

                $model = explode('::', $value);
                $item->{$key}($model[1]::withoutGlobalScopes()->find($model[2]));

            } elseif (is_string($value) && Str::startsWith($value, 'rambo-resource::')) {

                $item->{$key}(Resource::fromLivewire($value));

            } else {

                $item->{$key}($value);

            }
        });

        return $item;
    }
}
