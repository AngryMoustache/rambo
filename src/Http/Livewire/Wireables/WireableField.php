<?php

namespace AngryMoustache\Rambo\Http\Livewire\Wireables;

use AngryMoustache\Rambo\Fields\Field;
use AngryMoustache\Rambo\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Wireable;

class WireableField implements Wireable
{
    public function toLivewire()
    {
        $field = clone $this;

        foreach (array_keys((array) $field) as $key) {
            $value = $field->{$key};
            if ($value instanceof Model) {
                $field->{$key} = 'rambo-model::' . get_class($value) . '::' . $value->id;
            }

            if ($value instanceof Resource) {
                $field->{$key} = $field->{$key}->toLivewire();
            }
        }

        return base64_encode(json_encode([
            'class' => get_class($field),
            'values' => (array) $field,
        ]));
    }

    public static function fromLivewire($field)
    {
        if ($field instanceof Field) {
            return clone $field;
        }

        $field = json_decode(base64_decode($field));
        $values = collect($field->values ?? []);
        $field = new $field->class;

        $values->each(function ($value, $key) use (&$field) {
            // Fetch models again
            if (is_string($value) && Str::startsWith($value, 'rambo-model::')) {

                $model = explode('::', $value);
                $field->{$key}($model[1]::withoutGlobalScopes()->find($model[2]));

            } elseif (is_string($value) && Str::startsWith($value, 'rambo-resource::')) {

                $field->{$key}(Resource::fromLivewire($value));

            } else {

                $field->{$key}($value);

            }
        });

        return $field;
    }
}
