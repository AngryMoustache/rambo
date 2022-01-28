<?php

namespace AngryMoustache\Rambo\Traits;

use AngryMoustache\Rambo\Http\Livewire\Crud\Buttons\SubmitButton;

trait Buttons
{
    public function buttons($type)
    {
        return $this->{"${type}Buttons"}() ?? [];
    }

    public function formButtons()
    {
        return [
            SubmitButton::class,
        ];
    }

    public function createButtons()
    {
        return $this->buttons('form');
    }

    public function editButtons()
    {
        return $this->buttons('form');
    }
}
