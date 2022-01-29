<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use AngryMoustache\Rambo\Fields\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Wireable;

class WireableField implements Wireable
{
    public function toLivewire()
    {
        // Fetch models again
        foreach (array_keys((array) $this) as $key) {
            if ($this->{$key} instanceof Model) {
                $this->{$key} = 'rambo-model::' . get_class($this->{$key}) . '::' . $this->{$key}->id;
            }
        }

        return base64_encode(json_encode([
            'class' => get_class($this),
            'values' => (array) $this,
        ]));
    }

    public static function fromLivewire($field)
    {
        if ($field instanceof Field) {
            return $field;
        }

        $field = json_decode(base64_decode($field));
        $values = collect($field->values ?? []);
        $field = new $field->class;

        $values->each(function ($value, $key) use (&$field) {
            // Fetch models again
            if (is_string($value) && Str::startsWith($value, 'rambo-model::')) {
                $model = explode('::', $value);
                $field->{$key}($model[1]::withoutGlobalScopes()->find($model[2]));
            } else {
                $field->{$key}($value);
            }
        });

        return $field;
    }
}
