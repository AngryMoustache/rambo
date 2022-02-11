<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Resource;

/**
 * @method $this options(array $options) The list of options to display [value => label]
 * @method $this resource(object|string $resource) The resource to pull items from
 * @method $this nullable(boolean $nullable = true) Adds an empty select option at the top
 */
class SelectField extends Field
{
    public $bladeShowComponent = 'rambo::livewire.fields.show.select';

    public $options = [];

    public function resource($resource)
    {
        if (! $resource instanceof Resource) {
            $resource = new $resource;
        }

        $this->resource = $resource;
        $this->options = $resource->relationQuery()->pluck(
            $resource->displayNameField(),
            $resource->primaryField()
        );

        return $this;
    }

    public function enum($enum)
    {
        $this->options = collect($enum::cases())
            ->mapWithKeys(fn ($item) => [$item->name => $item->value])
            ->toArray();

        return $this;
    }

    public function getShowValue()
    {
        $value = parent::getValue();
        if ($this->resource && $value) {
            $this->link = $this->resource->show($value);
        }

        return $this->options[parent::getShowValue()] ?? null;
    }
}
