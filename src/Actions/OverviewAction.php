<?php

namespace AngryMoustache\Rambo\Actions;

use AngryMoustache\Rambo\Facades\Rambo;

class OverviewAction extends Action
{
    public $icon = 'fas fa-table';
    public $label = 'Overview';

    public function getLink($resource, $item)
    {
        return $resource->index();
    }

    public function shouldHide()
    {
        return ! $this->resource->canViewIndex()
            || Rambo::currentUrl() === $this->resource->index();
    }
}
