<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Http\Livewire\Crud\Buttons\SubmitButton;
use AngryMoustache\Rambo\Http\Livewire\Crud\Buttons\SubmitContinueButton;

trait Buttons
{
    public function buttons($type)
    {
        return $this->{"${type}Buttons"}() ?? [];
    }

    public function createButtons()
    {
        return [
            SubmitButton::class,
        ];
    }

    public function editButtons()
    {
        return [
            SubmitContinueButton::class,
            SubmitButton::class,
        ];
    }
}
