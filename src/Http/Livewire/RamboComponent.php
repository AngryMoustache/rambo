<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use Livewire\Component;

class RamboComponent extends Component
{
    public $component;
    public $layout = 'rambo::layouts.admin';

    public function render()
    {
        return view($this->component)
            ->extends($this->layout);
    }
}
