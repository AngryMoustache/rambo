<?php

namespace AngryMoustache\Rambo\Actions;

class ShowAction extends Action
{
    public $icon = 'far fa-eye';
    public $label = 'Show';

    public function getLink($resource, $item)
    {
        return $resource->show($item->id);
    }

    public function shouldHide($resource = null, $currentRoute = null)
    {
        return $resource->show() === $currentRoute;
    }
}
