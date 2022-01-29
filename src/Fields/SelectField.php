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
    public $showComponent = 'rambo::livewire.fields.show.select';
    public $formComponent = 'rambo::livewire.fields.form.select';

    public $options = [];

    public function resource($resource)
    {
        if (! $resource instanceof Resource) {
            $resource = new $resource;
        }

        $this->resource = $resource;
        $this->options = $resource->relationQuery()->pluck(
            $resource->displayName(),
            $resource->primaryField()
        );

        return $this;
    }

    public function getShowValue()
    {
        if ($this->resource) {
            $this->link = $this->resource->show(parent::getValue());
        }

        return $this->options[parent::getShowValue()] ?? null;
    }
}
