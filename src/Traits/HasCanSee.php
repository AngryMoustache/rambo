<?php

namespace AngryMoustache\Rambo\Traits;

trait HasCanSee
{
    public $canSee = true;

    public function shouldHide($resource)
    {
        return false;
    }

    public function canBeSeen($resource)
    {
        return $this->canSee && ! $this->shouldHide($resource);
    }
}
