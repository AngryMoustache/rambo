<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Facades\Rambo;

class EditAction extends Action
{
    public $icon = 'far fa-edit';
    public $label = 'Edit';

    public function getLink($resource, $item)
    {
        return $resource->edit($item->id);
    }

    public function shouldHide($resource = null)
    {
        return ! $resource->can('edit')
            || Rambo::currentUrl() === $resource->edit();
    }
}
