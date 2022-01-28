<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Actions\CreateAction;
use AngryMoustache\Rambo\Actions\DeleteAction;
use AngryMoustache\Rambo\Actions\EditAction;
use AngryMoustache\Rambo\Actions\OverviewAction;
use AngryMoustache\Rambo\Actions\ShowAction;

trait Actions
{
    public function actions($type)
    {
        return $this->{"${type}Actions"}() ?? [];
    }

    public function itemActions()
    {
        return [
            ShowAction::class,
            EditAction::class,
            DeleteAction::class,
        ];
    }

    public function tableActions()
    {
        return $this->actions('item');
    }

    public function showActions()
    {
        return $this->actions('item');
    }

    public function editActions()
    {
        return $this->actions('item');
    }

    public function formActions()
    {
        return [
            OverviewAction::class,
            CreateAction::class,
        ];
    }

    public function createActions()
    {
        return $this->actions('form');
    }

    public function indexActions()
    {
        return $this->actions('form');
    }
}
