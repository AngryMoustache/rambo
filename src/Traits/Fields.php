<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Fields\Field;
use Exception;

trait Fields
{
    public $fields;

    private $fieldStacks = [];
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
    public function fieldStack($stack = '')
    {
        $this->fieldStack[$stack] ??= collect($this->fields())
            ->reject(fn ($field) => in_array($stack, $field->getHideFrom() ?? []));

        return $this->fieldStack[$stack];
    }

    /**
     * Returns the fields that are searchable
     */
    public function searchableFields($stack = '')
    {
        $this->searchableFields[$stack] ??= $this->fieldStack($stack)
            ->filter(fn ($field) => $field->isSearchable());

        return $this->searchableFields[$stack];
    }

    /**
     * Returns the validation stack
     * If create or edit rules are specified, take those
     */
    public function validationStack($stack = '')
    {
        $this->validationStack[$stack] ??= $this->fieldStack($stack)
            ->mapWithKeys(fn (Field $field) => [
                "fields.{$field->getName()}" => $field->getRules($stack) ?? []
            ])->toArray();

        return $this->validationStack[$stack];
    }
}
