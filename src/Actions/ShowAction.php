<?php

namespace AngryMoustache\Rambo\Actions;

class ShowAction extends Action
{
    public static $icon = 'far fa-eye';
    public static $label = 'Show';

    public static function getLink($resource, $item)
    {
        return $resource->show($item->id);
    }
}
