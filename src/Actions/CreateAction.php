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

    public function shouldHide($resource = null)
    {
        return ! $resource->can('create')
            || Rambo::currentUrl() === $resource->create();
    }
}
