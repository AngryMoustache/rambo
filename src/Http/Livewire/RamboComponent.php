<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use Livewire\Component;

class RamboComponent extends Component
{
    public $layout = 'rambo::layouts.admin';
    protected $componentData = [];

    public function mount()
    {
        //
    }

    public function fillComponentData()
    {
        $this->componentData = [];
    }

    public function render()
    {
        return view($this->component, $this->componentData)
            ->extends($this->layout);
    }
}
