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

    public function itemActions()
    {
        return [
            ShowAction::class,
            EditAction::class,
            DeleteAction::class,
        ];
    }

    public function indexActions()
    {
        return $this->actions('item');
    }

    public function showActions()
    {
        return $this->actions('item');
    }
}
