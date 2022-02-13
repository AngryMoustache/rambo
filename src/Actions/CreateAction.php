<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Facades\Rambo;

class CreateAction extends Action
{
    public $icon = 'fas fa-plus';
    public $label = 'Create';

    public function getLink($resource, $item)
    {
        return $resource->create();
    }

    public function shouldHide()
    {
        return ! $this->resource->canCreate()
            || Rambo::currentUrl() === $this->resource->create();
    }
}
