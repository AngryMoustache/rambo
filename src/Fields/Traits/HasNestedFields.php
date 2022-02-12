<?php

namespace AngryMoustache\Rambo\Fields\Traits;

/**
 * @method $this getFields(object|null $item) Get the fields inside the group
 */
trait HasNestedFields
{
    public function getFields($item = null)
    {
        return collect($this->fields)
            ->map(fn ($field) => $field->item($item ?? $this->item))
            ->toArray();
    }
}
