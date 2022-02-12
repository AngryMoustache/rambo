<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Fields\Field;
use Exception;
use Illuminate\Support\Collection;

trait Fields
{
    public $fields;

    private $fieldStacks = [];
    private $flatFieldStacks = [];
    private $searchableFields = [];
    private $validationStack = [];

    public function fields()
    {
        // Don't make this an abstract function, we won't be able to use route binding otherwise
        throw new Exception('No fields() function found on your resource!');
    }

    /**
     * Returns the full field stack of the resource
     * You can specify the page you are on to look at the fields hideFrom
     */
    public function fieldStack($stack = '', $item = null)
    {
        return $this->fieldStack[$stack] ??= $this->parseFields(
            Collection::wrap($this->fields()),
            $stack,
            $item
        );
    }

    /**
     * Returns the full flattened field stack of the resource
     * This is needed for when you are using nested groups with additional fields
     */
    public function flatFieldStack($stack = '', $item = null)
    {
        $fields = Collection::wrap($this->fields())
            ->map(fn (Field $field) => $this->fieldsFromField($field, $item) ?? $field)
            ->flatten(1);

        return $this->flatFieldStack[$stack] ??= $this->parseFields($fields, $stack, $item);
    }

    /**
     * Returns the fields that are searchable
     */
    public function searchableFields($stack = '')
    {
        return $this->searchableFields[$stack] ??= $this->flatFieldStack($stack)
            ->filter(fn ($field) => $field->isSearchable());
    }

    /**
     * Returns the validation stack
     * If create or edit rules are specified, take those
     */
    public function validationStack($stack = '')
    {
        return $this->validationStack[$stack] ??= $this->flatFieldStack($stack)
            ->mapWithKeys(fn (Field $field) => ["fields.{$field->getName()}" => $field->getRules($stack) ?? []])
            ->toArray();
    }

    /**
     * Recursive field fetch
     */
    private function fieldsFromField($field, $item)
    {
        $fields = $field->getFields($item);
        if (! $fields) {
            return $field;
        }

        return Collection::wrap($fields)
            ->map(fn (Field $field) => $this->fieldsFromField($field, $item))
            ->flatten(1);
    }

    private function parseFields($fields, $stack = '', $item = null)
    {
        return Collection::wrap($fields)
            ->reject(fn ($field) => in_array($stack, $field->getHideFrom() ?? []))
            ->map(fn ($field) => $field->item($item ?? $this->item))
            ->map(fn ($field) => $field->stack($stack));
    }
}
