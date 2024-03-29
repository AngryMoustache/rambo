<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Facades\Rambo;

class ShowAction extends Action
{
    public $icon = 'far fa-eye';
    public $label = 'Show';

    public function getLink($resource, $item)
    {
        return $resource->show($item->id);
    }

    public function shouldHide($resource)
    {
        return ! $this->resource->canShow()
            || Rambo::currentUrl() === $this->resource->show();
    }
}
