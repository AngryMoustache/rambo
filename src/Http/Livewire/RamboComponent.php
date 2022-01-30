<?php

namespace AngryMoustache\Rambo\Http\Livewire;

use AngryMoustache\Rambo\Http\Livewire\Traits\RamboCanToast;
use Livewire\Component;

class RamboComponent extends Component
{
    use RamboCanToast;

    // Set to 'true' if you want to only load the page after everything is loaded
    public $preLoad = false;

    public $layout = 'rambo::layouts.admin';
    protected $componentData = [];

    public function addComponentData($values)
    {
        $this->componentData = array_merge($values, $this->componentData);
    }

    public function getComponentData()
    {
        return $this->componentData;
    }

    public function ready()
    {
        $this->preLoad = false;
    }

    public function render()
    {
        if ($this->preLoad) {
            return view('rambo::livewire.loading-state')
                ->extends($this->layout);
        }

        return view($this->component, $this->getComponentData())
            ->extends($this->layout);
    }
}
