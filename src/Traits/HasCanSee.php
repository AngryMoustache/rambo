<?php

namespace AngryMoustache\Rambo\Traits;

trait HasCanSee
{
    public $canSee = true;

    public function shouldHide($resource)
    {
        return false;
    }
}
