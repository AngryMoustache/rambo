<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Actions\DeleteAction;
use AngryMoustache\Rambo\Actions\EditAction;
use AngryMoustache\Rambo\Actions\ShowAction;

trait Actions
{
    public function actions($type)
    {
        return $this->{"${type}Actions"}() ?? [];
    }

    public function tableActions()
    {
        return [
            ShowAction::class,
            EditAction::class,
            DeleteAction::class,
        ];
    }

    public function indexActions()
    {
        return $this->actions('table');
    }

    public function showActions()
    {
        return $this->actions('table');
    }

    public function formActions()
    {
        return $this->actions('table');
    }

    public function createActions()
    {
        return $this->actions('form');
    }

    public function editActions()
    {
        return $this->actions('form');
    }
}
