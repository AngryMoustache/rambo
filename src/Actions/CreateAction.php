<?php

namespace AngryMoustache\Rambo\Actions;

class CreateAction extends Action
{
    public $icon = 'fas fa-plus';
    public $label = 'Create';

    public function getLink($resource, $item)
    {
        return $resource->create();
    }

    public function shouldHide($resource = null, $currentRoute = null)
    {
        return $resource->create() === $currentRoute;
    }
}
