<?php

namespace AngryMoustache\Rambo\Fields;

use AngryMoustache\Rambo\Resource;

/**
 * @method $this resource(object|string $resource) The resource to pull items from
 */
class HasManyField extends Field
{
    public $showComponent = 'rambo::livewire.fields.show.has-many';

    public $hideFrom = ['index', 'edit', 'create'];

    public $resource = null;

    public function resource($resource)
    {
        if (! $resource instanceof Resource) {
            $resource = new $resource;
        }

        $this->resource = $resource;
        return $this;
    }
}
