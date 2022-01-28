<?php

namespace AngryMoustache\Rambo\Actions;

class EditAction extends Action
{
    public $icon = 'far fa-edit';
    public $label = 'Edit';

    public function getLink($resource, $item)
    {
        return $resource->edit($item->id);
    }

    public function shouldHide($resource = null, $currentRoute = null)
    {
        return $resource->edit() === $currentRoute;
    }
}
