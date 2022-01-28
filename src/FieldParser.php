<?php

namespace AngryMoustache\Rambo;

use AngryMoustache\Rambo\Fields\Field;

class FieldParser
{
    public static function hydrate($field)
    {
        if ($field instanceof Field) {
            return $field;
        }

        $field = json_decode(base64_decode($field));
        $values = collect($field->values ?? []);
        $field = new $field->class;

        $values->each(fn ($value, $key) => $field->{$key}($value));
        return $field;
    }

    public static function dehydrate($field)
    {
        return base64_encode(json_encode([
            'class' => get_class($field),
            'values' => (array) $field,
        ]));
    }
}
