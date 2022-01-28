<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Buttons\CancelButton;
use AngryMoustache\Rambo\Buttons\SubmitButton;
use AngryMoustache\Rambo\Buttons\SubmitContinueButton;

trait Buttons
{
    public function buttons($type)
    {
        return $this->{"${type}Buttons"}() ?? [];
    }

    public function createButtons()
    {
        return [
            CancelButton::class,
            SubmitButton::class,
        ];
    }

    public function editButtons()
    {
        return [
            CancelButton::class,
            SubmitContinueButton::class,
            SubmitButton::class,
        ];
    }
}
