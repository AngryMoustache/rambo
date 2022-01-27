<?php

namespace AngryMoustache\Rambo\Actions;

class EditAction extends Action
{
    public static $icon = 'far fa-edit';
    public static $label = 'Edit';

    public static function getLink($resource, $item)
    {
        return $resource->edit($item->id);
    }
}
