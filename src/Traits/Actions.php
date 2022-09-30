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
            ShowAction::make(),
            EditAction::make(),
            DeleteAction::make(),
        ];
    }

    public function tableActions()
    {
        return $this->itemActions();
    }

    public function showActions()
    {
        return $this->itemActions();
    }

    public function editActions()
    {
        return $this->itemActions();
    }

    public function overviewActions()
    {
        return [
            OverviewAction::make(),
            CreateAction::make(),
        ];
    }

    public function createActions()
    {
        return $this->overviewActions();
    }

    public function indexActions()
    {
        return $this->overviewActions();
    }
}
