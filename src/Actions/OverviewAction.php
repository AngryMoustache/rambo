<?php

namespace AngryMoustache\Rambo\Actions;

class OverviewAction extends Action
{
    public $icon = 'fas fa-table';
    public $label = 'Overview';

    public function getLink($resource, $item)
    {
        return $resource->index();
    }

    public function shouldHide($resource = null, $currentRoute = null)
    {
        return $resource->index() === $currentRoute;
    }
}
