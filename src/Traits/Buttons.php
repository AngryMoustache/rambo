<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Buttons\CancelButton;
use AngryMoustache\Rambo\Buttons\SubmitButton;
use AngryMoustache\Rambo\Buttons\SubmitContinueButton;

trait Buttons
{
    public function createButtons()
    {
        return [
            CancelButton::make(),
            SubmitButton::make(),
        ];
    }

    public function editButtons()
    {
        return [
            CancelButton::make(),
            SubmitContinueButton::make(),
            SubmitButton::make(),
        ];
    }
}
