<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Rambo\Http\Livewire\Traits\RamboCanToast;
use Livewire\Component;

class RamboComponent extends Component
{
    use RamboCanToast;

    public $layout = 'rambo::layouts.admin';
    protected $componentData = [];

    public function booted()
    {
        //
    }

    public function addComponentData($values)
    {
        $this->componentData = array_merge($values, $this->componentData);
    }

    public function getComponentData()
    {
        return $this->componentData;
    }

    public function render()
    {
        return view($this->component, $this->getComponentData())
            ->extends($this->layout);
    }
}
