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
        $actions = $this->{"${type}Actions"}() ?? [];
        return collect($actions)
            ->map(fn ($action) => new $action)
            ->toArray();
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

    public function formActions()
    {
        return [
            OverviewAction::class,
            CreateAction::class,
        ];
    }

    public function createActions()
    {
        return $this->formActions();
    }

    public function indexActions()
    {
        return $this->formActions();
    }
}
