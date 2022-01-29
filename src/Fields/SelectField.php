<?php

namespace AngryMoustache\Rambo\Fields;

/**
 * @method $this options(array $options) The list of options to display [value => label]
 * @method $this resource(string $resourceClass) The resource to pull items from
 * @method $this nullable(boolean $nullable = true) Adds an empty select option at the top
 */
class SelectField extends Field
{
    public $showComponent = 'rambo::livewire.fields.show.select';
    public $formComponent = 'rambo::livewire.fields.form.select';

    public $options = [];
    public $resource;

    public function resource(string $resourceClass)
    {
        $resource = new $resourceClass;
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
            $this->link = $this->resource->show($this->item);
        }

        return $this->options[parent::getShowValue()] ?? null;
    }
}
